<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {

        return view('user.home');
    }
    public function list(Request $request)
    {
        // $products = Product::with('categories:id,name')
        //     ->get([
        //         'id',
        //         'product_title',
        //         'price',
        //         'short_description',
        //         'product_image'
        //     ]);
        // // if ($request->ajax()) {
        // //     return view('components.product-card', compact('products'))->render();
        // // }
        // return view('user.home');

        $products = Product::with('categories')
            ->withCount([
                'wishlists as is_wishlisted' => function ($q) {
                    $q->where('user_id', Auth::id());
                }
            ])
            ->get();

        if ($request->ajax()) {
            return view('components.product-card', compact('products'))->render();
        }

        return view('user.home', compact('products'));

        // $products = Product::with('categories')->get();
        // return view('components.product-card', compact('products'));


        //return response()->json($products);
    }
}
