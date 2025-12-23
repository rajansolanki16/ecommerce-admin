<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {

        return view('user.home');
    }
    public function list()
    {
        $products = Product::with('categories:id,name')
            ->get([
                'id',
                'product_title',
                'price',
                'short_description',
                'product_image'
            ]);

        return response()->json($products);
    }
}
