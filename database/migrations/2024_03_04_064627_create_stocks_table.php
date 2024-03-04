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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_id')->references('id')->on('agents')->cascadeOnDelete();
            $table->foreignId('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->string('verification_token')->nullable()->unique();
            $table->float('buying_price');
            $table->float('selling_price');
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('minimun_order')->default(0);
            $table->mediumText('product_description');
            $table->string('product_status')->default('Good');
            $table->boolean('is_published')->default(0);
            $table->boolean('is_verified')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
