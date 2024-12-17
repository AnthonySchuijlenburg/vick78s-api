<?php

namespace JsonApi;

use App\Models\Car;
use Tests\JsonApiTestCase;

class CarsTest extends JsonApiTestCase
{
    public function test_it_lists_cars()
    {
        Car::factory()->count(3)->create();
        $cars = Car::all()->sortBy('weight');

        $response = $this
            ->jsonApi()
            ->expects('cars')
            ->get('/api/v1/cars');

        $response->assertOk();
        $response->assertFetchedManyInOrder($cars);
    }

    public function test_it_find_car()
    {
        $car = Car::factory()->create();

        $response = $this
            ->jsonApi()
            ->expects('cars')
            ->get('/api/v1/cars/'.$car->getRouteKey());

        $response->assertOk();
        $response->assertFetchedOne($car);
    }

    public function test_it_find_cars_events()
    {
        $car = Car::factory()
            ->withEvents()
            ->create();

        $response = $this
            ->jsonApi()
            ->expects('events')
            ->get('/api/v1/cars/'.$car->getRouteKey().'/events');

        $response->assertOk();
        $response->assertFetchedManyInOrder(
            $car->events()
                ->orderBy('start_date')
                ->get()
        );
    }
}
