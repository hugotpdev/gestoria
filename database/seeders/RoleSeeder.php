<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Primer rol: member
        $role = new Role();
        $role->name="user";
        $role->save();

        // Segundo rol: admin
        $role = new Role();
        $role->name="admin";
        $role->save();
    }
}
