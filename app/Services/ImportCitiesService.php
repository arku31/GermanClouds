<?php

namespace App\Services;

use App\Models\City;
use App\Repositories\WeatherRepository;

class ImportCitiesService
{
    private WeatherRepository $weatherRepository;

    public function __construct(WeatherRepository $weatherRepository) 
    {
        $this->weatherRepository = $weatherRepository;
    }

    public function importCity(string $cityName): ?City 
    {
        $response = $this->weatherRepository->getCityCoordinates(
            $cityName,
            'DE'
        );
        
        if (!$response || !isset($response[0])) {
            return null;
        }

        $response = $response[0];

        return City::create([
            'name' => $cityName,
            'country_code' => 'DE',
            'lat' => $response['lat'],
            'lon' => $response['lon']
        ]);
    }
}

