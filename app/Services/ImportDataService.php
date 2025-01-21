<?php

namespace App\Services;

use App\Models\City;
use App\Models\WeatherData;
use App\Repositories\WeatherRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ImportDataService
{
    private WeatherRepository $weatherRepository;

    public function __construct(WeatherRepository $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    public function importWeatherData(City $city): void
    {
        $startDate = Carbon::now()->subDays(365);
        $endDate = Carbon::now();

        $baseFileName = sprintf(
            'weather_responses_%s',
            $city->name
        );

        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            $response = $this->weatherRepository->getWeatherByCoordinates(
                $city->getLatitude(),
                $city->getLongitude(), 
                $currentDate->format('Y-m-d')
            );
            
            if ($response) {
                $fileName = sprintf(
                    '%s_%s.json',
                    $baseFileName,
                    $currentDate->format('Y-m-d')
                );
                info("Got weather data for {$city->name} on {$currentDate->format('Y-m-d')}");
                Storage::put(storage_path('responses/') .
                    $fileName,
                    json_encode([
                        'date' => $currentDate->format('Y-m-d'),
                        'response' => $response
                    ], JSON_PRETTY_PRINT)
                );

                WeatherData::create([
                    'city_id' => $city->id,
                    'date' => $currentDate->format('Y-m-d'),
                    'temperature_min' => $response['temperature']['min'],
                    'temperature_max' => $response['temperature']['max'],
                    'cloudiness' => $response['cloud_cover']['afternoon'],
                ]);
            }
            
            $currentDate->addDay();
        }
    }
}
