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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->enum('type', ['percentage', 'fixed']);
            $table->decimal('amount', 8, 2);          
            $table->decimal('min_order_amount', 8, 2)->default(0); 
            $table->decimal('max_discount_amount', 8, 2)->nullable(); 
            $table->date('start_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('max_usage')->nullable();    
            $table->integer('max_usage_per_user')->default(1); 
            $table->integer('used')->default(0);          
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('coupon_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('used_count')->default(1);
            $table->timestamps();
        });
    }
};
