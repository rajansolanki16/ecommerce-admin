<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use Stripe\StripeClient;
use Razorpay\Api\Api as RazorpayApi;

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
            'name'            => 'required|string|max:255',
            'email'           => 'required|email',
            'phone'           => 'required|string|max:20',
            'address'         => 'required|string',
            'payment_method'  => 'nullable|string',
            'payment_status'  => 'nullable|string',
            'transaction_id'  => 'nullable|string',
        ]);

        $cart = $this->getCart($request);

        if ($cart->isEmpty()) {
            return back()->with('error', 'Your cart is empty');
        }

        $order = null;

        DB::transaction(function () use ($request, $cart, &$order) {
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

            // Create initial payment record
            Payment::create([
                'order_id'       => $order->id,
                'user_id'        => Auth::id(),
                'payment_method' => $request->input('payment_method', 'pending'),
                'amount'         => $total,
                'currency'       => getPaymentSetting('payment_currency', 'INR'),
                'status'         => 'pending',
                'transaction_id' => $request->input('transaction_id'),
            ]);

            // Log status change
            $order->updateStatus(
                'pending',
                'order_created',
                'system',
                null,
                ['payment_method' => $request->input('payment_method')]
            );

            if (Auth::check() && auth()->user()->cart) {
                auth()->user()->cart->items()->delete();
            }

            session()->forget('applied_coupon');
        });

        return redirect()
            ->route('checkout.success', $order->id)
            ->withCookie(cookie()->forget('guest_cart'));
    }

    public function createStripePaymentIntent(Request $request)
    {
        $totals = $this->calculateCartTotals($request);

        if ($totals['cart']->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty.'], 422);
        }

        if ($totals['total'] <= 0) {
            return response()->json(['message' => 'Invalid cart total.'], 422);
        }

        if (!getPaymentSetting('stripe_enabled', false)) {
            return response()->json(['message' => 'Stripe is not enabled.'], 403);
        }

        $stripeSecret = getPaymentSetting('stripe_secret');
        if (empty($stripeSecret)) {
            return response()->json(['message' => 'Stripe secret key is not configured.'], 500);
        }

        try {
            $stripe = new StripeClient($stripeSecret);
            $intent = $stripe->paymentIntents->create(
                [
                    'amount' => (int) round($totals['total'] * 100),
                    'currency' => strtolower(getPaymentSetting('payment_currency', 'INR')),
                    'payment_method_types' => ['card'],
                    'metadata' => [
                        'user_id' => Auth::id(),
                        'order_total' => $totals['total'],
                    ],
                ],
                ['idempotency_key' => Auth::id() . '-' . $request->session()->getId()] // Ensure idempotency
            );

            // Store payment intent ID in session for later verification
            session()->put('stripe_payment_intent_id', $intent->id);
            session()->put('stripe_client_secret', $intent->client_secret);

            return response()->json([
                'client_secret' => $intent->client_secret,
                'payment_intent_id' => $intent->id,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Stripe payment intent creation failed: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Verify Stripe payment and create order.
     * This is called after client-side Stripe confirmation.
     */
    public function verifyStripePayment(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required|string',
        ]);

        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $paymentIntentId = $request->input('payment_intent_id');
        $stripeSecret = getPaymentSetting('stripe_secret');

        if (empty($stripeSecret)) {
            return response()->json(['message' => 'Stripe is not configured'], 500);
        }

        try {
            $stripe = new StripeClient($stripeSecret);
            $paymentIntent = $stripe->paymentIntents->retrieve($paymentIntentId);

            if ($paymentIntent->status === 'succeeded') {
                // Create order if it doesn't exist
                $cart = $this->getCart($request);
                $order = null;

                DB::transaction(function () use ($request, $cart, $paymentIntent, &$order) {
                    // Check if order already exists for this payment intent
                    $existingPayment = Payment::where('transaction_id', $paymentIntent->id)->first();
                    if ($existingPayment) {
                        $order = $existingPayment->order;
                        return;
                    }

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
                        'name'      => $request->input('name', auth()->user()->name),
                        'email'     => $request->input('email', auth()->user()->email),
                        'phone'     => $request->input('phone'),
                        'address'   => $request->input('address'),
                        'subtotal'  => $subtotal,
                        'discount'  => $discount,
                        'total'     => $total,
                        'coupon_id' => $couponId,
                        'status'    => 'processing',
                    ]);

                    foreach ($cart as $item) {
                        OrderItem::create([
                            'order_id'   => $order->id,
                            'product_id' => $item['id'],
                            'price'      => $item['price'],
                            'quantity'   => $item['quantity'],
                        ]);
                    }

                    // Create payment record
                    $payment = Payment::create([
                        'order_id'       => $order->id,
                        'user_id'        => Auth::id(),
                        'payment_method' => 'stripe',
                        'transaction_id' => $paymentIntent->id,
                        'amount'         => $total,
                        'currency'       => strtoupper($paymentIntent->currency),
                        'status'         => 'succeeded',
                        'paid_at'        => now(),
                        'gateway_response' => [
                            'payment_intent_id' => $paymentIntent->id,
                            'charge_id' => $paymentIntent->charges->data[0]->id ?? null,
                            'receipt_email' => $paymentIntent->receipt_email,
                        ],
                    ]);

                    // Log status change
                    $order->updateStatus(
                        'processing',
                        'payment_succeeded',
                        'stripe_api',
                        null,
                        ['payment_intent_id' => $paymentIntent->id]
                    );

                    if (Auth::check() && auth()->user()->cart) {
                        auth()->user()->cart->items()->delete();
                    }

                    session()->forget('applied_coupon');
                    session()->forget('stripe_payment_intent_id');
                    session()->forget('stripe_client_secret');
                });

                return response()->json([
                    'success' => true,
                    'order_id' => $order->id,
                    'redirect_url' => route('checkout.success', $order->id),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment not completed. Status: ' . $paymentIntent->status,
                ], 422);
            }
        } catch (\Throwable $e) {
            \Log::error('Stripe payment verification failed: ' . $e->getMessage());
            return response()->json(['message' => 'Payment verification failed: ' . $e->getMessage()], 500);
        }
    }

    public function createRazorpayOrder(Request $request)
    {
        $totals = $this->calculateCartTotals($request);

        if ($totals['cart']->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty.'], 422);
        }

        if ($totals['total'] <= 0) {
            return response()->json(['message' => 'Invalid cart total.'], 422);
        }

        if (!getPaymentSetting('razorpay_enabled', false)) {
            return response()->json(['message' => 'Razorpay is not enabled.'], 403);
        }

        $razorpayKey = getPaymentSetting('razorpay_key_id');
        $razorpaySecret = getPaymentSetting('razorpay_key_secret');

        if (empty($razorpayKey) || empty($razorpaySecret)) {
            return response()->json(['message' => 'Razorpay keys are not configured.'], 500);
        }

        try {
            $api = new RazorpayApi($razorpayKey, $razorpaySecret);
            $orderData = [
                'amount' => (int) round($totals['total'] * 100),
                'currency' => strtoupper(getPaymentSetting('payment_currency', 'INR')),
                'payment_capture' => 1,
                'notes' => [
                    'user_id' => Auth::id(),
                    'source' => 'checkout',
                ],
            ];

            $razorpayOrder = $api->order->create($orderData);

            return response()->json([
                'order_id' => $razorpayOrder['id'],
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency'],
                'key' => $razorpayKey,
            ]);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
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

    private function calculateCartTotals(Request $request): array
    {
        $cart = $this->getCart($request);
        $subtotal = $cart->isEmpty() ? 0 : $cart->sum(fn ($i) => $i['price'] * $i['quantity']);
        $discount = 0;

        if ($coupon = session('applied_coupon')) {
            $discount = $this->calculateDiscount($coupon, $subtotal);
        }

        return [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => max(0, $subtotal - $discount),
        ];
    }

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