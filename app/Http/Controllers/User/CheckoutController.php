<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = $this->getCart($request);

        if ($cart->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty');
        }

        // Fetch products safely
        $products = Product::whereIn('id', $cart->pluck('id'))->get()->keyBy('id');

        $total = 0;

        foreach ($cart as &$item) {
            $product = $products->get($item['id']);

            if (!$product) {
                continue;
            }

            // Attach price safely
            $item['price'] = $product->sell_price ?? $product->price;
            $item['name']  = $product->product_title;

            $total += $item['price'] * $item['quantity'];
        }

        return view('user.checkout.index', compact('cart', 'total'));
    }
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required',
            'address' => 'required|string',
        ]);

        $cart = $this->getCart($request);

        if ($cart->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        DB::transaction(function () use ($request, $cart) {

            $order = Order::create([
                'user_id' => Auth::id(),
                'name'    => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                'address' => $request->address,
                'total'   => $cart->sum(fn ($i) => $i['price'] * $i['quantity']),
                'status'  => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['id'],
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                ]);
            }

            // Clear cart
            if (Auth::check()) {
                auth()->user()->cart->items()->delete();
            }
        });


        return redirect()->route('checkout.success')->withCookie(cookie()->forget('guest_cart'));
    }

    private function getCart(Request $request)
    {
        if (Auth::check()) {
            return collect(auth()->user()->cart->items->map(fn ($i) => [
                'id'       => $i->product_id,
                'name'     => $i->product->name,
                'price'    => $i->price,
                'quantity' => $i->quantity,
                'image'    => $i->product->image,
            ]));
        }

        return collect(json_decode($request->cookie('guest_cart', '[]'), true));
    }

    public function success()
    {
        return view('user.checkout.success');
    }
}