<?php

namespace App\Models;

use Database\Factories\NewsItemFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static NewsItemFactory factory(...$parameters)
 */
class NewsItem extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'published_at',
    ];

    protected $casts = [
        'content' => 'json',
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
