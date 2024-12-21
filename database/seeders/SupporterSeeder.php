<?php

namespace Database\Seeders;

use App\Models\Supporter;
use Illuminate\Database\Seeder;

class SupporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supporter::factory()->count(10)->create(['active' => false]);
        Supporter::factory()->count(10)->create(['active' => true]);
    }
}
