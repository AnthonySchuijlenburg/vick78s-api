<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
