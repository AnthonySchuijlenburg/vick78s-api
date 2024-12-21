<?php

namespace App\Models;

use Database\Factories\SupporterFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static SupporterFactory factory(...$parameters)
 */
class Supporter extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'active',
        'weight',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
