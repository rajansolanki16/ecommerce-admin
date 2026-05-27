<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'description', 'type', 'amount',
        'min_order_amount', 'max_discount_amount',
        'start_date', 'expiry_date',
        'max_usage', 'max_usage_per_user', 'used', 'is_active',
    ];

    protected $casts = [
        'start_date'  => 'date',
        'expiry_date' => 'date',
        'is_active'   => 'boolean',
    ];

    // ─── Relationships ────────────────────────────────────────────
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // ─── Validation Logic ─────────────────────────────────────────
    public function isValid(float $cartTotal, ?int $userId = null): array
    {
        if (!$this->is_active) {
            return ['valid' => false, 'message' => 'This coupon is inactive.'];
        }

        $today = Carbon::today();

        if ($this->start_date && $today->lt($this->start_date)) {
            return ['valid' => false, 'message' => 'This coupon is not active yet.'];
        }

        if ($this->expiry_date && $today->gt($this->expiry_date)) {
            return ['valid' => false, 'message' => 'This coupon has expired.'];
        }

        if ($this->max_usage !== null && $this->used >= $this->max_usage) {
            return ['valid' => false, 'message' => 'This coupon has reached its usage limit.'];
        }

        if ($this->min_order_amount !== null && $cartTotal < $this->min_order_amount) {
            return [
                'valid'   => false,
                'message' => 'Minimum order of ₹' . number_format($this->min_order_amount, 2) . ' required.',
            ];
        }

        // Per-user limit — checked via orders table, no pivot needed
        if ($this->max_usage_per_user !== null && $userId) {
            $userUsageCount = Order::where('coupon_id', $this->id)
                ->where('user_id', $userId)
                ->count();

            if ($userUsageCount >= $this->max_usage_per_user) {
                return ['valid' => false, 'message' => 'You have already used this coupon the maximum number of times.'];
            }
        }

        return ['valid' => true, 'message' => 'Coupon applied successfully.'];
    }

    // ─── Discount Calculation ─────────────────────────────────────
    public function calculateDiscount(float $cartTotal): float
    {
        $discount = $this->type === 'percentage'
            ? ($cartTotal * $this->amount / 100)
            : (float) $this->amount;

        if ($this->max_discount_amount !== null) {
            $discount = min($discount, $this->max_discount_amount);
        }

        return min($discount, $cartTotal);
    }

    // ─── Usage Tracking ───────────────────────────────────────────
    // Called after order is placed — just increments the 'used' counter

    public function redeem(): void
    {
        $this->increment('used');
    }
}