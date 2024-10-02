<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory, HasSpatial, HasTranslations;

    protected $casts = [
        'center' => Point::class,
    ];

    public $translatable = ['name'];

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }
}
