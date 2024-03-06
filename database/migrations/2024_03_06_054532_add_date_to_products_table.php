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
        Schema::table('products', function (Blueprint $table) {
            $table->date('manufactured_date')->default('2023-11-03 12:51:22');
            $table->date('expiry_date')->default('2024-11-03 12:51:22');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('products', ['manufactured_date', 'expiry_date']);
    }
};
