<?php

namespace JsonApi;

use App\Models\ImageCollection;
use Tests\JsonApiTestCase;

class ImageCollectionTest extends JsonApiTestCase
{
    public function test_it_lists_sponsors()
    {
        ImageCollection::factory()->count(3)->create();
        $imageCollections = ImageCollection::all()->sortBy('weight');

        $response = $this
            ->jsonApi()
            ->expects('image-collections')
            ->get('/api/v1/image-collections');

        $response->assertOk();
        $response->assertFetchedManyInOrder($imageCollections);
    }

    public function test_it_find_sponsor()
    {
        $imageCollection = ImageCollection::factory()->create();

        $response = $this
            ->jsonApi()
            ->expects('image-collections')
            ->get('/api/v1/image-collections/'.$imageCollection->getRouteKey());

        $response->assertOk();
        $response->assertFetchedOne($imageCollection);
    }
}
