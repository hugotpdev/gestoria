<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios automáticamente por nombre o email
        $user1 = User::where('email', 'user1@piopio.com')->first();
        $admin1 = User::where('email', 'admin1@piopio.com')->first();

        // Crear propiedades asociadas al usuario con email 'user1@piopio.com'
        Property::create([
            'user_id' => $user1->id,  
            'title' => 'Casa en Madrid',
            'description' => 'Casa de 3 habitaciones en el centro de Madrid.',
            'price' => 300000,
            'location' => 'Madrid',
            'type' => 'venta',
            'status' => 'disponible',
            'bedrooms' => 3, 
            'bathrooms' => 2,
            'area' => 120.50,
            'image_url' => '/properties/Casa_de_lujo_Barcelona.JPG', 
        ]);

        Property::create([
            'user_id' => $user1->id, 
            'title' => 'Piso en Barcelona',
            'description' => 'Piso con vista al mar en Barcelona.',
            'price' => 250000,
            'location' => 'Barcelona',
            'type' => 'alquiler',
            'status' => 'disponible',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'area' => 90.00,
            'image_url' => '/properties/Casa_de_lujo_Barcelona.JPG',
        ]);

        // Crear propiedades asociadas al usuario con email 'admin1@piopio.com'
        Property::create([
            'user_id' => $admin1->id,  
            'title' => 'Apartamento en Valencia',
            'description' => 'Apartamento moderno de 2 habitaciones.',
            'price' => 150000,
            'location' => 'Valencia',
            'type' => 'venta',
            'status' => 'disponible',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'area' => 75.00,
            'image_url' => '/properties/Casa_de_lujo_Barcelona.JPG',
        ]);

        Property::create([
            'user_id' => $admin1->id,  
            'title' => 'Casa en Sevilla',
            'description' => 'Casa de campo en las afueras de Sevilla.',
            'price' => 350000,
            'location' => 'Sevilla',
            'type' => 'alquiler',
            'status' => 'disponible',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'area' => 200.00,
            'image_url' => '/properties/Casa_de_lujo_Barcelona.JPG',
        ]);
    }
}
