<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderStatusAudit extends Model
{
    use HasFactory;

    protected $table = 'order_status_audits';

    protected $fillable = [
        'order_id',
        'old_status',
        'new_status',
        'reason',
        'notes',
        'triggered_by',
        'changed_by_user_id',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'json',
    ];

    /**
     * Get the order associated with the audit.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user who made the change.
     */
    public function changedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by_user_id');
    }

    /**
     * Scope to filter by reason.
     */
    public function scopeByReason($query, string $reason)
    {
        return $query->where('reason', $reason);
    }

    /**
     * Scope to filter by triggered_by.
     */
    public function scopeTriggeredBy($query, string $triggeredBy)
    {
        return $query->where('triggered_by', $triggeredBy);
    }

    /**
     * Scope to filter by status.
     */
    public function scopeWithNewStatus($query, string $status)
    {
        return $query->where('new_status', $status);
    }
}
