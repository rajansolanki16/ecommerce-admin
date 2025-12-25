<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    //
    public function index()
    {
        $wishlists = WishList::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('user.wishlist.index', compact('wishlists'));
    }
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist = WishList::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            // remove from wishlist
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        }

        // add to wishlist
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return response()->json(['status' => 'added']);
    }
    public function showadmin()
    {
        $wishlists = WishList::with(['user', 'product'])
            ->latest()
            ->get();

        return view('admin.wishlist.index', compact('wishlists'));
    }
    public function deleteById($id)
    {
         $wishlist = Wishlist::where('id', $id)
        ->where('user_id',  auth()->id())
        ->first();

        if (!$wishlist) {
            return response()->json(['status' => 'error'], 404);
        }

        $wishlist->delete();

        return response()->json(['status' => 'success']);
    }
}
