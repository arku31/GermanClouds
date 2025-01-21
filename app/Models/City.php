<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'country_code', 'lat', 'lon'];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where(is_numeric($value) ? 'id' : 'name', $value)
            ->firstOrFail();
    }

    public function weatherData(): HasMany
    {
        return $this->hasMany(WeatherData::class);
    }

    public function getLatitude(): float
    {
        return $this->lat;
    }

    public function getLongitude(): float
    {
        return $this->lon;
    }
}
