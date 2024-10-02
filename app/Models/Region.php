<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use Spatie\Translatable\HasTranslations;

class Region extends Model
{
    use HasFactory, HasSpatial, HasTranslations;

    protected $casts = [
        'center' => Point::class,
        'boundaries' => Polygon::class,
    ];

    public $translatable = ['name'];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

}
