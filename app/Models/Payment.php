<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'payment_method',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'gateway_response',
        'failure_reason',
        'attempt_count',
        'paid_at',
        'failed_at',
        'refunded_at',
    ];

    protected $casts = [
        'gateway_response' => 'json',
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'failed_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];

    /**
     * Get the order associated with the payment.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user associated with the payment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if payment is successful.
     */
    public function isSucceeded(): bool
    {
        return $this->status === 'succeeded';
    }

    /**
     * Check if payment failed.
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Check if payment is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if payment is refunded.
     */
    public function isRefunded(): bool
    {
        return $this->status === 'refunded';
    }

    /**
     * Mark payment as succeeded.
     */
    public function markAsSucceeded(array $gatewayResponse = null): void
    {
        $this->update([
            'status' => 'succeeded',
            'paid_at' => now(),
            'gateway_response' => $gatewayResponse,
        ]);
    }

    /**
     * Mark payment as failed.
     */
    public function markAsFailed(string $reason = null, array $gatewayResponse = null): void
    {
        $this->update([
            'status' => 'failed',
            'failed_at' => now(),
            'failure_reason' => $reason,
            'gateway_response' => $gatewayResponse,
        ]);
    }

    /**
     * Mark payment as refunded.
     */
    public function markAsRefunded(): void
    {
        $this->update([
            'status' => 'refunded',
            'refunded_at' => now(),
        ]);
    }

    /**
     * Increment attempt count.
     */
    public function incrementAttempt(): void
    {
        $this->increment('attempt_count');
    }
}
