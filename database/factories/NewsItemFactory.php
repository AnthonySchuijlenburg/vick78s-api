<?php

namespace Database\Factories;

use App\Models\NewsItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<NewsItem>
 */
class NewsItemFactory extends Factory
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
            'published_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
        ];
    }
}
