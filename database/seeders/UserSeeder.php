<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User member
        $user = new User();
        $user->name="User1";
        $user->email="user1@piopio.com";
        $user->password=Hash::make("secret");
        $role_member=Role::where("name", "user")->first();
        $user->save();
        $user->roles()->attach($role_member);

        // User member2
        $user = new User();
        $user->name="User2";
        $user->email="user2@piopio.com";
        $user->password=Hash::make("secret");
        $role_member=Role::where("name", "user")->first();
        $user->save();
        $user->roles()->attach($role_member);

        // User admin
        $user = new User();
        $user->name="Admin1";
        $user->email="admin1@piopio.com";
        $user->password=Hash::make("secret");
        $role_member=Role::where("name", "admin")->first();
        $user->save();
        $user->roles()->attach($role_member);
    }
}
