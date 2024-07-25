<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'model_year',
        'engine',
        'transmission',
        'image_url',
        'content',
        'weight',
    ];

    protected $casts = [
        'content' => 'json',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
