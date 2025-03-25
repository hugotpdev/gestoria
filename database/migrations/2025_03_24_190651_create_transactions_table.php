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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade'); 
            $table->foreignId('buyer_id')->onstrained('users')->onDelete('set null');
            $table->foreignId('seller_id')->onstrained('users')->onDelete('set null'); 
            $table->decimal('price', 10, 2); 
            $table->timestamp('transaction_date'); 
            $table->enum('type', ['venta', 'alquiler']);
            $table->enum('status', ['pendiente', 'completado']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
