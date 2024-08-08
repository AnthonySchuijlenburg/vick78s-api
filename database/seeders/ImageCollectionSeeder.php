<?php

namespace Database\Seeders;

use App\Models\ImageCollection;
use Illuminate\Database\Seeder;

class ImageCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImageCollection::factory(10)
            ->create();
    }
}
