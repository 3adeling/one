<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use Spatie\Translatable\HasTranslations;

class District extends Model
{
    use HasFactory, HasSpatial, HasTranslations;

    protected $casts = [
        'boundaries' => Polygon::class,
    ];

    public $translatable = ['name'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }
}
