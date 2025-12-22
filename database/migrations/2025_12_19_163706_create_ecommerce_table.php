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
        Schema::create('ecommerce', function (Blueprint $table) {
            $table->id();
            $table->string('currency_symbol');
            $table->string('currency_word');
            $table->string('store_address');
            $table->string('store_city');

            // Explicit column type matching country.id
            $table->unsignedBigInteger('store_country');

            // Add foreign key
            $table->foreign('store_country')
                ->references('id')
                ->on('country')
                ->onDelete('cascade');

            $table->integer('store_postal_code');
            $table->string('weight_unit');
            $table->string('dimension_unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecommerce');
    }
};
