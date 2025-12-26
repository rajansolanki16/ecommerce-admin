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

        $userId = Auth::id();
      
        $wishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $status = 'removed';
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
            ]);
            $status = 'added';
        }

        //  IMPORTANT: updated wishlist count
        Wishlist::where('user_id', $userId)->count();

        return response()->json([
            'status' => $status,
            'count'  => Wishlist::where('user_id', Auth::id())->count()
        ]);
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
        $count = Wishlist::where('user_id', auth()->id())->count();

        return response()->json(['status' => 'success','count'=>$count]);
    }
}
