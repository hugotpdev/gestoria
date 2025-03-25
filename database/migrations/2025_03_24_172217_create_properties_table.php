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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('location');
            $table->enum('type', ['venta', 'alquiler']);
            $table->enum('status', ['disponible', 'reservado', 'vendido', 'alquilado'])->default('disponible');
            $table->integer('bedrooms')->nullable(); // Número de habitaciones
            $table->integer('bathrooms')->nullable(); // Número de baños
            $table->decimal('area', 8, 2)->nullable(); // Superficie en metros cuadrados
            $table->string('image_url')->nullable(); // URL de la imagen de la propiedad
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
