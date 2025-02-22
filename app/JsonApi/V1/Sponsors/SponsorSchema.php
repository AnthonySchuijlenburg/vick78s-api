<?php

namespace App\JsonApi\V1\Sponsors;

use App\Models\Sponsor;
use Illuminate\Support\Facades\Storage;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Number;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class SponsorSchema extends Schema
{
    /**
     * The model the schema corresponds to.
     */
    public static string $model = Sponsor::class;

    protected $defaultSort = 'weight';

    /**
     * Get the resource fields.
     */
    public function fields(): array
    {
        return [
            ID::make()->uuid(),
            Str::make('name'),
            Str::make('logo')
                ->serializeUsing(
                    fn ($value) => $value ? asset(Storage::url($value)) : null,
                ),
            Str::make('url'),
            Number::make('weight')->sortable(),
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
