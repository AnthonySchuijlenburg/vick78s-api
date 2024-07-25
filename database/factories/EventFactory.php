<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::ucfirst($this->faker->words(3, true).' '.$city = $this->faker->city),
            'location' => $city,
            'start_date' => $start = $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'end_date' => $end = Carbon::parse($start)->addDays($this->faker->numberBetween(1, 3)),
            'date' => $this->getDateLabel($start, $end),
            'car' => $this->faker->randomElement([
                'Mercedes 190E 2.3-16',
                'BMW M3',
                'Porsche 944 Turbo',
            ]),
            'class' => Str::ucfirst($this->faker->words(2, true)),
        ];
    }

    private function getDateLabel(DateTime $startDate, DateTime $endDate): string
    {
        $startDay = $startDate->format('j');
        $endDay = $endDate->format('j');
        $month = $startDate->format('F');
        $year = $startDate->format('Y');

        return "$startDay/$endDay $month $year";
    }
}
