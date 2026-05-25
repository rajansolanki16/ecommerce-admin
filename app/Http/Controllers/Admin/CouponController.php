<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'code' => 'required|unique:coupons,code',
            'type' => 'required|in:percentage,fixed',
            'amount' => 'required|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:start_date',
            'max_usage' => 'nullable|integer|min:1',
        ];
        $messages = [
            'code.required' => 'The coupon code field is required.',
            'code.unique' => 'This coupon code is already in use.',
            'type.required' => 'The discount type field is required.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'start_date.required' => 'The start date field is required.',
            'expiry_date.required' => 'The expiry date field is required.',
            'expiry_date.after_or_equal' => 'The expiry date must be equal to or after the start date.',
            'max_usage.integer' => 'Maximum usage must be a whole number.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $coupon = new Coupon;
        $coupon->code = Str::upper(trim($request->code));
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->discount_amount = $request->discount_amount;
        $coupon->description = $request->description;
        $coupon->start_date = $request->start_date;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->max_usage = $request->max_usage;
        $coupon->save();

        if ($coupon) {
            return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create coupon. Please try again.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'code' => "required|unique:coupons,code,{$id}",
            'type' => 'required|in:percentage,fixed',
            'amount' => 'required|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:start_date',
            'max_usage' => 'nullable|integer|min:1',
        ];
        $messages = [
            'code.required' => 'The coupon code field is required.',
            'code.unique' => 'This coupon code is already in use.',
            'type.required' => 'The discount type field is required.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'start_date.required' => 'The start date field is required.',
            'expiry_date.required' => 'The expiry date field is required.',
            'expiry_date.after_or_equal' => 'The expiry date must be equal to or after the start date.',
            'max_usage.integer' => 'Maximum usage must be a whole number.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $coupon = Coupon::findOrFail($id);
        $coupon->code = Str::upper(trim($request->code));
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->discount_amount = $request->discount_amount;
        $coupon->description = $request->description;
        $coupon->start_date = $request->start_date;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->max_usage = $request->max_usage;
        $coupon->save();
        if ($coupon) {
            return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update coupon. Please try again.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
