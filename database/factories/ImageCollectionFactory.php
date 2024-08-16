<?php

namespace Database\Factories;

use App\Models\ImageCollection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ImageCollection>
 */
class ImageCollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $name = $this->faker->sentence,
            'slug' => Str::slug($name),
            'weight' => $this->faker->numberBetween(1, 100),
            'made_by' => $this->faker->name,
            'image_urls' => [],
        ];
    }
}
