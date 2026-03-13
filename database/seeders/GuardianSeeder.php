<?php

namespace Database\Seeders;

use App\Domains\Guardians\Models\Guardian;
use Illuminate\Database\Seeder;

class GuardianSeeder extends Seeder
{
    public function run(): void
    {
        Guardian::factory(20)->create();
    }
}
