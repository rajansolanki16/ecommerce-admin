<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Orders list page
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->withCount('items')
            ->latest()
            ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }
}
