<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PaymentSettingsController extends Controller
{
    public function index()
    {
        $settings = PaymentSetting::pluck('value', 'key');
        return view('admin.settings.payment', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'payment_currency'       => 'required|string|max:10',
            'stripe_key'             => 'nullable|string',
            'stripe_secret'          => 'nullable|string',
            'stripe_webhook_secret'  => 'nullable|string',
            'razorpay_key_id'        => 'nullable|string',
            'razorpay_key_secret'    => 'nullable|string',
        ]);

        $fields = [
            'stripe_enabled'         => $request->boolean('stripe_enabled'),
            'stripe_key'             => $request->input('stripe_key'),
            'stripe_secret'          => $request->input('stripe_secret'),
            'stripe_webhook_secret'  => $request->input('stripe_webhook_secret'),
            'razorpay_enabled'       => $request->boolean('razorpay_enabled'),
            'razorpay_key_id'        => $request->input('razorpay_key_id'),
            'razorpay_key_secret'    => $request->input('razorpay_key_secret'),
            'payment_currency'       => $request->input('payment_currency'),
            'payment_mode'           => $request->input('payment_mode', 'sandbox'),
            'cod_enabled'            => $request->boolean('cod_enabled'),
        ];

        foreach ($fields as $key => $value) {
            PaymentSetting::set($key, $value);
        }

        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return back()->with('success', 'Payment settings saved successfully.');
    }
}