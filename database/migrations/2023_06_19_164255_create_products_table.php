<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('pharmacy_id')->default(1);
            $table->integer('category_id')->default(1);
            $table->string('product_name');
            $table->string('product_photo');
            $table->string('serial')->unique();
            $table->string('verification_token')->nullable()->unique();
            $table->float('buying_price');
            $table->float('selling_price');
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('minimun_order')->default(0);
            $table->mediumText('product_description');
            $table->string('product_status')->default('Good');
            $table->boolean('is_published')->default(0);
            $table->enum('is_verified',[0,1,2])->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
