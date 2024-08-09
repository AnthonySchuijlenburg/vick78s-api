<?php

namespace App\JsonApi\V1\Cars;

use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ArrayHash;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Relations\HasMany;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class CarSchema extends Schema
{
    /**
     * The model the schema corresponds to.
     */
    public static string $model = Car::class;

    protected $defaultSort = 'weight';

    /**
     * Get the resource fields.
     */
    public function fields(): array
    {
        return [
            ID::make()->uuid(),
            Str::make('title'),
            Str::make('slug'),
            Str::make('model_year'),
            Str::make('engine'),
            Str::make('transmission'),
            Str::make('image_url')
                ->serializeUsing(
                    fn ($value) => $value ? asset(Storage::url($value)) : null,
                ),
            ArrayHash::make('content'),
            Str::make('weight')->sortable(),
            HasMany::make('events')->type('events')->readOnly(),
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
