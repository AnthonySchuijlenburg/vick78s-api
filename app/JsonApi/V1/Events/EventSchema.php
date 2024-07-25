<?php

namespace App\JsonApi\V1\Events;

use App\Models\Event;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class EventSchema extends Schema
{
    /**
     * The model the schema corresponds to.
     */
    public static string $model = Event::class;

    protected $defaultSort = 'startDate';

    /**
     * Get the resource fields.
     */
    public function fields(): array
    {
        return [
            ID::make()->uuid(),
            Str::make('name'),
            Str::make('location'),
            DateTime::make('startDate')->sortable(),
            DateTime::make('endDate')->sortable(),
            Str::make('date'),
            Str::make('car'),
            Str::make('class'),
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
