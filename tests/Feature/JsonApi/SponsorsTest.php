<?php

namespace JsonApi;

use App\Models\Sponsor;

class SponsorsTest extends \Tests\JsonApiTestCase
{
    public function test_it_lists_sponsors()
    {
        Sponsor::factory()->count(3)->create();
        $sponsors = Sponsor::all()->sortBy('weight');

        $response = $this
            ->jsonApi()
            ->expects('sponsors')
            ->get('/api/v1/sponsors');

        $response->assertOk();
        $response->assertFetchedManyInOrder($sponsors);
    }

    public function test_it_find_sponsor()
    {
        $sponsor = Sponsor::factory()->create();

        $response = $this
            ->jsonApi()
            ->expects('sponsors')
            ->get('/api/v1/sponsors/'.$sponsor->getRouteKey());

        $response->assertOk();
        $response->assertFetchedOne($sponsor);
    }
}
