<?php

namespace JsonApi;

use App\Models\NewsItem;

class NewsItemsTest extends \Tests\JsonApiTestCase
{
    public function testItListsNewsItems()
    {
        NewsItem::factory()->count(3)->create();
        $newsItems = NewsItem::all()->sortBy('published_at', null, 'desc');

        $response = $this
            ->jsonApi()
            ->expects('news-items')
            ->get('/api/v1/news-items');

        $response->assertOk();
        $response->assertFetchedManyInOrder($newsItems);
    }

    public function testItFindNewsItem()
    {
        $newsItem = NewsItem::factory()->create();

        $response = $this
            ->jsonApi()
            ->expects('news-items')
            ->get('/api/v1/news-items/'.$newsItem->getRouteKey());

        $response->assertOk();
        $response->assertFetchedOne($newsItem);
    }
}
