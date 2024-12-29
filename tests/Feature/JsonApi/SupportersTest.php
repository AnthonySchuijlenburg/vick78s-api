<?php

namespace JsonApi;

use App\Models\Supporter;

class SupportersTest extends \Tests\JsonApiTestCase
{
    public function test_it_lists_supporters()
    {
        Supporter::factory()->count(3)->create(['active' => true]);
        $supporters = Supporter::all()->sortBy('name');

        $response = $this
            ->jsonApi()
            ->expects('supporters')
            ->get('/api/v1/supporters');

        $response->assertOk();
        $response->assertFetchedManyInOrder($supporters);
    }

    public function test_it_only_lists_active_supporters()
    {
        Supporter::factory()->count(3)->create(['active' => true]);
        Supporter::factory()->count(3)->create(['active' => false]);
        $supporters = Supporter::all()->where('active', true)->sortBy('name');

        $response = $this
            ->jsonApi()
            ->expects('supporters')
            ->get('/api/v1/supporters');

        $response->assertOk();
        $response->assertFetchedManyInOrder($supporters);
    }

    public function test_it_find_supporter()
    {
        $supporter = Supporter::factory()->create(['active' => true]);

        $response = $this
            ->jsonApi()
            ->expects('supporters')
            ->get('/api/v1/supporters/'.$supporter->getRouteKey());

        $response->assertOk();
        $response->assertFetchedOne($supporter);
    }
}
