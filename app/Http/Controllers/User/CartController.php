<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($product->stock <= 0) {
            return response()->json([
                'message' => '*This Product is Out Of Stock',
                'product_id' => $product->id
            ], 422);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "id" => $product->id,
                "name" => $product->product_title,
                "price" => $product->price,
                "image" => $product->product_image,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        //  total cart count (session based)
        $count = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'status' => 'success',
            'count' => $count,
            'product' => [
                'id' => $product->id,
                'name' => $product->product_title,
                'price' => $product->price
            ]
        ]);

        //return redirect()->back()->with('success', 'Product added to cart');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            // Recalculate grand total
            $grandTotal = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));

            // Get cart count
            $count = array_sum(array_column($cart, 'quantity'));

            return response()->json([
                'status' => 'success',
                'message' => 'Product removed from cart',
                'count' => $count,
                'grandTotal' => $grandTotal,
                'cartEmpty' => empty($cart)
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Product not found in cart'
        ], 404);
    }
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $newQuantity = max(1, (int)$request->quantity);
            $cart[$id]['quantity'] = $newQuantity;
            session()->put('cart', $cart);

            $itemTotal = $cart[$id]['price'] * $newQuantity;

            $grandTotal = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));

            // Get total cart count
            $count = array_sum(array_column($cart, 'quantity'));

            return response()->json([
                'status' => 'success',
                'itemTotal' => $itemTotal,
                'grandTotal' => $grandTotal,
                'count' => $count,
                'quantity' => $newQuantity
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Product not found in cart'
        ], 404);
    }
}
