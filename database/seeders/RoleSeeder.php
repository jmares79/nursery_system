<?php

namespace Database\Seeders;

use App\Domains\Roles\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'description' => 'System Administrator'
        ]);

        Role::create([
            'name' => 'manager',
            'description' => 'Nursery Manager'
        ]);

        Role::create([
            'name' => 'staff',
            'description' => 'Nursery Staff'
        ]);
    }
}
