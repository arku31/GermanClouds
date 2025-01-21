<?php

namespace App\Services;

use App\Models\City;
use App\Repositories\WeatherDataRepository;
use Carbon\Carbon;

class GetWeatherDataService
{

    public function __construct(private WeatherDataRepository $weatherDataRepository)
    {
    }

    public function getWeatherDataFromDb(array $cityIds, ?Carbon $dateFrom = null, ?Carbon $dateTo = null)
    {
        $weatherData = $this->weatherDataRepository->getWeatherDataFromDb($cityIds, $dateFrom, $dateTo);
        return collect([
            'aggregations' => [
                'by_city' => $weatherData->groupBy('city_id')->map(function($cityData, $cityId) {
                    return [
                        'city_id' => $cityId,
                        'avg_min_temperature' => $cityData->avg('temperature_min'),
                        'avg_max_temperature' => $cityData->avg('temperature_max'),
                        'avg_cloudiness' => $cityData->avg('cloudiness'),
                    ];
                })->values(),
                'total' => [
                    'avg_min_temperature' => $weatherData->avg('temperature_min'),
                    'avg_max_temperature' => $weatherData->avg('temperature_max'),
                    'avg_cloudiness' => $weatherData->avg('cloudiness'),
                ]
            ],
            'data' => $weatherData,
        ]);
    }
}
