<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(15);
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $request->merge(['is_active' => $request->boolean('is_active')]);
        $validated = $request->validate([
            'code'                => 'required|string|unique:coupons,code',
            'type'                => 'required|in:percentage,fixed',
            'amount'              => 'required|numeric|min:0',
            'min_order_amount'    => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'description'         => 'nullable|string|max:500',
            'start_date'          => 'nullable|date',
            'expiry_date'         => 'nullable|date|after_or_equal:start_date',
            'max_usage'           => 'nullable|integer|min:1',
            'max_usage_per_user'  => 'nullable|integer|min:1',
            'is_active'           => 'boolean',
        ]);

        if ($validated['type'] === 'percentage' && $validated['amount'] > 100) {
            return back()->withErrors(['amount' => 'Percentage discount cannot exceed 100.'])->withInput();
        }

        Coupon::create($validated);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $request->merge(['is_active' => $request->boolean('is_active')]);

        $validated = $request->validate([
            'code'                => 'required|string|unique:coupons,code,' . $id,
            'type'                => 'required|in:percentage,fixed',
            'amount'              => 'required|numeric|min:0',
            'min_order_amount'    => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'description'         => 'nullable|string|max:500',
            'start_date'          => 'nullable|date',
            'expiry_date'         => 'nullable|date|after_or_equal:start_date',
            'max_usage'           => 'nullable|integer|min:1',
            'max_usage_per_user'  => 'nullable|integer|min:1',
            'is_active'           => 'boolean',
        ]);

        if ($validated['type'] === 'percentage' && $validated['amount'] > 100) {
            return back()->withErrors(['amount' => 'Percentage discount cannot exceed 100.'])->withInput();
        }

        $coupon->update($validated);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(string $id)
    {
        Coupon::findOrFail($id)->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }

    // Toggle active status quickly from the index table
    public function toggleStatus(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['is_active' => !$coupon->is_active]);
        return back()->with('success', 'Coupon status updated.');
    }
}
