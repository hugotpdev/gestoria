<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios automáticamente por nombre o email
        $user1 = User::where('email', 'user1@piopio.com')->first();
        $admin1 = User::where('email', 'admin1@piopio.com')->first();

        // Obtener propiedades existentes
        $property1 = Property::where('title', 'Casa en Madrid')->first();
        $property2 = Property::where('title', 'Piso en Barcelona')->first();

        
        Transaction::create([
            'property_id' => $property1->id,
            'buyer_id' => $user1->id,  
            'seller_id' => $admin1->id, 
            'price' => $property1->price,
            'transaction_date' => now(),
            'type' => $property1->type, 
            'status' => 'completado', 
        ]);

        Transaction::create([
            'property_id' => $property2->id,
            'buyer_id' => $admin1->id,  
            'seller_id' => $user1->id, 
            'price' => $property2->price,
            'transaction_date' => now(),
            'type' => $property2->type, 
            'status' => 'pendiente', 
        ]);
    }
}
