<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'user_id','name','email','phone','address','total','status','subtotal', 'discount', 'coupon_id'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
    ];

    /**
     * Get the order items.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the user associated with the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all payments for this order.
     */
    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the latest payment for this order.
     */
    public function latestPayment()
    {
        return $this->payments()->latest()->first();
    }

    /**
     * Get all status audits for this order.
     */
    public function statusAudits(): HasMany
    {
        return $this->hasMany(OrderStatusAudit::class);
    }

    /**
     * Get the coupon associated with the order.
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Check if order has a successful payment.
     */
    public function isPaid(): bool
    {
        return $this->payments()->where('status', 'succeeded')->exists();
    }

    /**
     * Get the successful payment.
     */
    public function successfulPayment()
    {
        return $this->payments()->where('status', 'succeeded')->first();
    }

    /**
     * Update order status with audit log.
     */
    public function updateStatus(string $newStatus, string $reason = null, string $triggeredBy = 'manual_update', ?int $changedByUserId = null, array $metadata = null): OrderStatusAudit
    {
        $oldStatus = $this->status;

        // Create audit log
        $audit = $this->statusAudits()->create([
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'reason' => $reason,
            'triggered_by' => $triggeredBy,
            'changed_by_user_id' => $changedByUserId,
            'metadata' => $metadata,
        ]);

        // Update order status
        $this->update(['status' => $newStatus]);

        return $audit;
    }
}