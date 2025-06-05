<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            "name" => "admin",
            "email" => "gastonrodriguez401@gmail.com",
            "password" => bcrypt(env('ADMIN_PASSWORD')),
            "role_id" => 1,
        ]);
    }
}

