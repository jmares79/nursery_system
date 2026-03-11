<?php

namespace Database\Seeders;

use App\Domains\Roles\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@nursery.local',
            'password' => bcrypt('password'),
            'role_id' => Role::first()->id,
        ]);
    }
}
