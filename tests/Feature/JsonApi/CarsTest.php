<?php

namespace JsonApi;

use App\Models\Car;
use Tests\JsonApiTestCase;

class CarsTest extends JsonApiTestCase
{
    public function testItListsCars()
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

    public function testItFindCar()
    {
        $car = Car::factory()->create();

        $response = $this
            ->jsonApi()
            ->expects('cars')
            ->get('/api/v1/cars/'.$car->getRouteKey());

        $response->assertOk();
        $response->assertFetchedOne($car);
    }

    public function testItFindCarsEvents()
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
