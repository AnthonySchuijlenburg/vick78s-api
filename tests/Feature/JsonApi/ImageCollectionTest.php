<?php

namespace JsonApi;

use App\Models\ImageCollection;
use Tests\JsonApiTestCase;

class ImageCollectionTest extends JsonApiTestCase
{
    public function testItListsSponsors()
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

    public function testItFindSponsor()
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
