<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->sentence,
            'slug' => Str::slug($title),
            'model_year' => $this->faker->year,
            'engine' => $this->faker->word,
            'transmission' => $this->faker->word,
            'image_url' => $this->faker->imageUrl(),
            'content' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'text' => $this->faker->paragraph,
                                'type' => 'text',
                            ],
                        ],
                    ],
                ],
            ],
            'weight' => $this->faker->numberBetween(0, 100),
        ];
    }
}
