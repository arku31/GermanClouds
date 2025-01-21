<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherData extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_id',
        'date',
        'temperature_min',
        'temperature_max',
        'cloudiness'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function city(): BelongsTo {
        return $this->belongsTo(City::class);
    }
}
