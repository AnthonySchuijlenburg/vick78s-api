<?php

namespace JsonApi;

use App\Models\NewsItem;
use Illuminate\Testing\Assert;
use Tests\JsonApiTestCase;

class NewsItemsTest extends JsonApiTestCase
{
    public function test_it_lists_news_items()
    {
        NewsItem::factory()->published()->count(3)->create();
        $newsItems = NewsItem::all()->sortBy('published_at', null, 'desc');

        $response = $this
            ->jsonApi()
            ->expects('news-items')
            ->get('/api/v1/news-items');

        $response->assertOk();
        $response->assertFetchedManyInOrder($newsItems);
    }

    public function test_it_find_news_item()
    {
        $newsItem = NewsItem::factory()->published()->create();

        $response = $this
            ->jsonApi()
            ->expects('news-items')
            ->get('/api/v1/news-items/'.$newsItem->getRouteKey());

        $response->assertOk();
        $response->assertFetchedOne($newsItem);
    }

    public function test_it_lists_only_available_news_items()
    {
        NewsItem::factory()->published()->count(3)->create();
        $newsItems = NewsItem::all()->sortBy('published_at', null, 'desc');

        // Create a news item that is not yet published
        NewsItem::factory()->scheduled()->create();

        $response = $this
            ->jsonApi()
            ->expects('news-items')
            ->get('/api/v1/news-items');

        $response->assertOk();
        $response->assertFetchedManyInOrder($newsItems);
        Assert::assertCount(3, $response->json('data'));
    }
}
