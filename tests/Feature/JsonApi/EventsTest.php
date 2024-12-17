<?php

namespace JsonApi;

use App\Models\Car;
use App\Models\Event;

class EventsTest extends \Tests\JsonApiTestCase
{
    public function test_it_lists_events()
    {
        Event::factory()->count(3)->create();
        $events = Event::all()->sortBy('start_date');

        $response = $this
            ->jsonApi()
            ->expects('events')
            ->get('/api/v1/events');

        $response->assertOk();
        $response->assertFetchedManyInOrder($events);
    }

    public function test_it_find_event()
    {
        $event = Event::factory()->create();

        $response = $this
            ->jsonApi()
            ->expects('events')
            ->get('/api/v1/events/'.$event->getRouteKey());

        $response->assertOk();
        $response->assertFetchedOne($event);
    }

    public function test_it_find_events_car()
    {
        $car = Car::factory()
            ->withEvents(1)
            ->create();
        $event = $car->events->first();

        $response = $this
            ->jsonApi()
            ->expects('cars')
            ->get('/api/v1/events/'.$event->getRouteKey().'/car');

        $response->assertOk();
        $response->assertFetchedOne($car);
    }
}
