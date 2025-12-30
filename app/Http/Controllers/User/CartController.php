<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // ---------------- GUEST
        if (!Auth::check()) {
            $cart = collect(
                json_decode($request->cookie('guest_cart', '[]'), true)
            );

            $products = Product::whereIn('id', $cart->pluck('id'))->get();

            $cartItems = $products->map(function ($product) use ($cart) {
                $qty = $cart->firstWhere('id', $product->id)['quantity'] ?? 1;
                return [
                    'product'  => $product,
                    'quantity' => $qty,
                    'total'    => $product->price * $qty
                ];
            });

            return view('user.cart.index', [
                'cartItems' => $cartItems,
                'isGuest'   => true
            ]);
        }

        // ---------------- LOGGED IN
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        return view('user.cart.index', [
            'cartItems' => $cart->items,
            'isGuest'   => false
        ]);
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($product->stock <= 0) {
            return response()->json(['message' => 'Out of stock'], 422);
        }

        /* ---------- GUEST ---------- */
        if (!Auth::check()) {

            $cart = collect(
                json_decode($request->cookie('guest_cart', '[]'), true)
            );

            $item = $cart->firstWhere('id', $product->id);

            if ($item) {
                $cart = $cart->map(fn ($i) =>
                    $i['id'] == $product->id
                        ? ['id' => $i['id'], 'quantity' => $i['quantity'] + 1]
                        : $i
                );
            } else {
                $cart->push(['id' => $product->id, 'quantity' => 1]);
            }

            return response()->json([
                'status' => 'added',
                'count'  => $cart->sum('quantity')
            ])->cookie(
                'guest_cart',
                json_encode($cart->values()),
                60 * 24 * 7
            );
        }

        /* ---------- LOGGED IN ---------- */
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $item = CartItem::firstOrCreate([
            'cart_id'   => $cart->id,
            'product_id'=> $product->id
        ], [
            'quantity' => 0,
            'price'    => $product->price
        ]);

        $item->increment('quantity');

        return response()->json([
            'status' => 'added',
            'count'  => $cart->items()->sum('quantity')
        ]);
    }
    public function remove(Request $request, int $productId)
    {
        /* ---------- GUEST ---------- */
        if (!Auth::check()) {

            $cart = collect(
                json_decode($request->cookie('guest_cart', '[]'), true)
            )->reject(fn ($i) => $i['id'] == $productId)->values();

            return response()->json([
                'status' => 'removed',
                'count'  => $cart->sum('quantity')
            ])->cookie(
                'guest_cart',
                json_encode($cart),
                60 * 24 * 7
            );
        }

        /* ---------- LOGGED IN ---------- */
        $cart = Cart::where('user_id', auth()->id())->first();

        CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->delete();

        return response()->json([
            'status' => 'removed',
            'count'  => $cart->items()->sum('quantity')
        ]);
    }
    public function update(Request $request, int $productId)
    {
        $qty = max(1, (int)$request->quantity);

        /* ---------- GUEST ---------- */
        if (!Auth::check()) {

            $cart = collect(
                json_decode($request->cookie('guest_cart', '[]'), true)
            )->map(fn ($i) =>
                $i['id'] == $productId
                    ? ['id' => $i['id'], 'quantity' => $qty]
                    : $i
            );

            return response()->json([
                'status' => 'updated',
                'count'  => $cart->sum('quantity')
            ])->cookie(
                'guest_cart',
                json_encode($cart->values()),
                60 * 24 * 7
            );
        }

        $cart = Cart::where('user_id', auth()->id())->first();

        CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->update(['quantity' => $qty]);

        return response()->json([
            'status' => 'updated',
            'count'  => $cart->items()->sum('quantity')
        ]);
    }
}
