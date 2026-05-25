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
    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_user')
                    ->withPivot('used_count')
                    ->withTimestamps();
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

        if ($cartTotal < $this->min_order_amount) {
            return [
                'valid'   => false,
                'message' => "Minimum order amount of {$this->min_order_amount} required.",
            ];
        }

        if ($userId) {
            $userUsage = $this->users()
                              ->where('user_id', $userId)
                              ->first()?->pivot->used_count ?? 0;

            if ($userUsage >= $this->max_usage_per_user) {
                return ['valid' => false, 'message' => 'You have already used this coupon.'];
            }
        }

        return ['valid' => true, 'message' => 'Coupon applied successfully.'];
    }

    // ─── Discount Calculation ─────────────────────────────────────
    public function calculateDiscount(float $cartTotal): float
    {
        $discount = $this->type === 'percentage'
            ? ($cartTotal * $this->amount / 100)
            : $this->amount;

        // Cap percentage discounts if max_discount_amount is set
        if ($this->max_discount_amount !== null) {
            $discount = min($discount, $this->max_discount_amount);
        }

        // Discount can't exceed cart total
        return min($discount, $cartTotal);
    }

    // ─── Usage Tracking ───────────────────────────────────────────
    public function redeem(int $userId): void
    {
        $this->increment('used');

        $existing = $this->users()->where('user_id', $userId)->first();

        if ($existing) {
            $this->users()->updateExistingPivot($userId, [
                'used_count' => $existing->pivot->used_count + 1,
            ]);
        } else {
            $this->users()->attach($userId, ['used_count' => 1]);
        }
    }
}