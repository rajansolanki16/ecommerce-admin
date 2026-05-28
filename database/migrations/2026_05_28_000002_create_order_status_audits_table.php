<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_status_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->string('reason')->nullable(); // manual_update, payment_succeeded, payment_failed, webhook, etc.
            $table->text('notes')->nullable();
            $table->string('triggered_by')->nullable(); // system, admin, webhook, etc.
            $table->foreignId('changed_by_user_id')->nullable()->constrained('users')->onDelete('set null'); // Admin user ID
            $table->json('metadata')->nullable(); // Additional context
            $table->timestamps();
            
            // Indexes
            $table->index('order_id');
            $table->index('new_status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_audits');
    }
};
