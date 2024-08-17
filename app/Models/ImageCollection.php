<?php

namespace App\Models;

use Database\Factories\ImageCollectionFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static ImageCollectionFactory factory(...$parameters)
 */
class ImageCollection extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'weight',
        'made_by',
        'image_urls',
    ];

    protected $casts = [
        'image_urls' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
