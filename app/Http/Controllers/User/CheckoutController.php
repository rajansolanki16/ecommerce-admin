<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;


class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = $this->getCart($request);

        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $subtotal = $cart->sum(fn ($i) => $i['price'] * $i['quantity']);
        $discount = 0;

        if ($coupon = session('applied_coupon')) {
            $discount = $this->calculateDiscount($coupon, $subtotal);

            // Keep discount in session in sync (in case subtotal changed)
            session()->put('applied_coupon.discount', round($discount, 2));
        }

        $total = max(0, $subtotal - $discount);
        return view('user.checkout.index', compact(
            'cart', 'subtotal', 'discount', 'total'
        ));
    }
    
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $cart = $this->getCart($request);

        if ($cart->isEmpty()) {
            return back()->with('error', 'Your cart is empty');
        }

        DB::transaction(function () use ($request, $cart) {
            $subtotal = $cart->sum(fn ($i) => $i['price'] * $i['quantity']);
            $discount = 0;
            $couponId = null;

            if ($coupon = session('applied_coupon')) {
                $couponId = $coupon['id'];
                $discount = $this->calculateDiscount($coupon, $subtotal);
                Coupon::where('id', $couponId)->increment('used');
            }

            $total = max(0, $subtotal - $discount);

            $order = Order::create([
                'user_id'   => Auth::id(),
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'subtotal'  => $subtotal,
                'discount'  => $discount,
                'total'     => $total,
                'coupon_id' => $couponId,
                'status'    => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['id'],
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                ]);
            }

            if (Auth::check() && auth()->user()->cart) {
                auth()->user()->cart->items()->delete();
            }

            session()->forget('applied_coupon');
        });

        return redirect()
            ->route('checkout.success')
            ->withCookie(cookie()->forget('guest_cart'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        // Calculate cart total server-side — never trust user POST
        $cart      = $this->getCart($request);
        $cartTotal = $cart->sum(fn ($i) => $i['price'] * $i['quantity']);

        if ($cartTotal <= 0) {
            return back()->with('error', 'Your cart is empty.');
        }

        $coupon = Coupon::where('code', strtoupper($request->code))->where('is_active', true)->first();

        if (!$coupon) {
            return back()->with('error', 'Invalid coupon code.');
        }

        $result = $coupon->isValid($cartTotal, auth()->id());
        if (!$result['valid']) {
            return back()->with('error', $result['message']);
        }

        $discount = $coupon->calculateDiscount($cartTotal);
        session()->put('applied_coupon', [
            'id'       => $coupon->id,
            'code'     => $coupon->code,
            'type'     => $coupon->type,
            'amount'   => $coupon->amount,
            'discount' => round($discount, 2),
        ]);

        return back()->with('success', 'Coupon applied! You save ₹' . number_format($discount, 2));
    }
    public function removeCoupon()
    {
        session()->forget('applied_coupon');
        return back()->with('success', 'Coupon removed.');
    }

    public function success()
    {
        return view('user.checkout.success');
    }

    // ─── Private Helpers ────────────────────────────────────────────────────────

    private function calculateDiscount(array $coupon, float $subtotal): float
    {
        if ($coupon['type'] === 'percentage') {
            $discount = ($subtotal * $coupon['amount']) / 100;
        } else {
            $discount = $coupon['amount'];
        }

        return min($discount, $subtotal); // never exceed subtotal
    }

    private function getCart(Request $request)
    {
        if (Auth::check()) {
            $cart = auth()->user()->cart
                ? auth()->user()->cart->items->map(fn ($i) => [
                    'id'       => $i->product_id,
                    'quantity' => $i->quantity,
                ])
                : collect();
        } else {
            $cart = collect(json_decode($request->cookie('guest_cart', '[]'), true));
        }

        if ($cart->isEmpty()) {
            return collect();
        }

        $products = Product::whereIn('id', $cart->pluck('id'))
            ->get()
            ->keyBy('id');

        return $cart->map(function ($item) use ($products) {
            $product = $products->get($item['id']);

            if (!$product) return null;

            return [
                'id'       => $product->id,
                'name'     => $product->product_title,
                'price'    => $product->sell_price ?? $product->price,
                'quantity' => $item['quantity'],
                'image'    => $product->product_image,
            ];
        })->filter()->values();
    }
}