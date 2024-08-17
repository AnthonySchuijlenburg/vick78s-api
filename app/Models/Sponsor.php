<?php

namespace App\Models;

use Database\Factories\SponsorFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static SponsorFactory factory(...$parameters)
 */
class Sponsor extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'logo',
        'url',
        'weight',
    ];
}
