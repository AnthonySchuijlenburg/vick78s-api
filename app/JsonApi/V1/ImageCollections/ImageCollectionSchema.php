<?php

namespace App\JsonApi\V1\ImageCollections;

use App\Models\ImageCollection;
use Illuminate\Support\Facades\Storage;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ArrayHash;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Number;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class ImageCollectionSchema extends Schema
{
    /**
     * The model the schema corresponds to.
     */
    public static string $model = ImageCollection::class;

    protected $defaultSort = 'weight';

    /**
     * Get the resource fields.
     */
    public function fields(): array
    {
        return [
            ID::make()->matchAs('[a-z0-9-]+'),
            Str::make('title'),
            Number::make('weight')->sortable(),
            Str::make('made_by'),
            ArrayHash::make('image_urls')
                ->serializeUsing(
                    fn ($value) => $value
                        ? array_map(fn ($item) => asset(Storage::url($item)), $value)
                        : null,
                ),
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
