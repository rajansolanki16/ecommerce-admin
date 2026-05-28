<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Orders list page
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->withCount('items')->latest()->paginate(10);
        return view('user.orders.index', compact('orders'));
    }
    public function indexshow()
    {
        $orders = Order::with(['user', 'items.product', 'payments'])->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,complete',
        ]);

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'success' => true,
            'status' => $order->status,
        ]);
    }

    /**
     * Admin: show a single order's details
     */
    public function adminShow(Order $order)
    {
        $order->load(['user', 'items.product', 'payments']);
        return view('admin.orders.show', compact('order'));
    }
}
