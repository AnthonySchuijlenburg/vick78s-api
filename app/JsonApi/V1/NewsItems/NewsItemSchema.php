<?php

namespace App\JsonApi\V1\NewsItems;

use App\Models\NewsItem;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ArrayHash;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class NewsItemSchema extends Schema
{
    /**
     * The model the schema corresponds to.
     */
    public static string $model = NewsItem::class;

    protected $defaultSort = '-publishedAt';

    /**
     * Get the resource fields.
     */
    public function fields(): array
    {
        return [
            ID::make()->uuid(),
            Str::make('title'),
            Str::make('slug'),
            ArrayHash::make('content'),
            DateTime::make('publishedAt')->sortable()->readOnly(),
            DateTime::make('createdAt')->sortable()->readOnly(),
            DateTime::make('updatedAt')->sortable()->readOnly(),
        ];
    }

    /**
     * Get the resource filters.
     */
    public function filters(): array
    {
        return [
            WhereIdIn::make($this),
        ];
    }

    /**
     * Get the resource paginator.
     */
    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }
}
