<?php

namespace Database\Factories;

use App\Models\sponsor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<sponsor>
 */
class SponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'logo' => $this->faker->imageUrl,
            'url' => $this->faker->url,
            'weight' => $this->faker->numberBetween(1, 100),
        ];
    }
}
