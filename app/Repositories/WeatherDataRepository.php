<?php

namespace App\Repositories;

use Carbon\Carbon;

class WeatherDataRepository
{
    public function getWeatherDataFromDb(array $cities, ?Carbon $dateFrom = null, ?Carbon $dateTo = null)
    {
        $query = \App\Models\WeatherData::query();

        if ($cities) {
            $query->whereIn('city_id', $cities);
        }

        if ($dateFrom && $dateTo) {
            $query->whereBetween('date', [$dateFrom, $dateTo]);
        } elseif ($dateFrom) {
            $query->where('date', '>=', $dateFrom);
        } elseif ($dateTo) {
            $query->where('date', '<=', $dateTo);
        }

        return $query->get();
    }
}
