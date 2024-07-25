<?php

namespace JsonApi;

use App\Models\Event;

class EventsTest extends \Tests\JsonApiTestCase
{
    public function testItListsEvents()
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

    public function testItFindSponsor()
    {
        $event = Event::factory()->create();

        $response = $this
            ->jsonApi()
            ->expects('events')
            ->get('/api/v1/events/'.$event->getRouteKey());

        $response->assertOk();
        $response->assertFetchedOne($event);
    }
}
