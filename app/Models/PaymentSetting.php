<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    public static function get(string $key, $default = null)
    {
        $record = static::where('key', $key)->first();
        if (!$record) return $default;

        try {
            return decrypt($record->value);
        } catch (\Exception $e) {
            return $record->value;
        }
    }

    public static function set(string $key, $value, string $group = 'payment')
    {
        $encrypted = in_array($key, self::sensitiveKeys())
            ? encrypt($value)
            : $value;

        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $encrypted, 'group' => $group]
        );
    }

    private static function sensitiveKeys(): array
    {
        return [
            'stripe_secret',
            'stripe_webhook_secret',
            'razorpay_key_secret',
        ];
    }
}