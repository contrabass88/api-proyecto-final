<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'description' => 'admin'],
            ['id' => 2, 'description' => 'student'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['id' => $role['id']],
                ['description' => $role['description']]
            );
        }
    }
}
