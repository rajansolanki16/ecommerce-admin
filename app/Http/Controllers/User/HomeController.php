<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
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
        if (Auth::check()) {
            $products = Product::with('categories')
                ->withCount([
                    'wishlists as is_wishlisted' => function ($q) {
                        $q->where('user_id', Auth::id());
                    }
                ])->paginate(8);
        } else {
            $products = Product::with('categories')->paginate(8);
        }

        $blogs = BlogPost::with(['category', 'author'])
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        if ($request->ajax()) {
            /** @var \Illuminate\Pagination\LengthAwarePaginator $products */
            return response()->json([
                'html' => view('components.product-card', compact('products'))->render(),
                'pagination' => $products->links('pagination::bootstrap-4'), 
            ]);
        }

        return view('user.home', compact('products', 'blogs'));
    }
}
