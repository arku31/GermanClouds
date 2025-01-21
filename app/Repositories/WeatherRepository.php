<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class WeatherRepository
{
    private string $apiKey;
    private Client $client;

    public function __construct(string $apiKey, Client $client)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
    }

    public function getWeatherByCoordinates(float $lat, float $lon, string $date): array
    {
        $response = $this->client->get('/data/3.0/onecall/day_summary', [
            'query' => [
                'lat' => $lat,
                'lon' => $lon,
                'date' => $date,
                'units' => 'metric',
                'appid' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getCityCoordinates(string $city, string $countryCode): array
    {
        $response = $this->client->get('/geo/1.0/direct', [
            'query' => [
                'q' => $city . ',' . $countryCode,
                'limit' => 1,
                'appid' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getWeatherByTimestamp(float $lat, float $lon, int $timestamp): array
    {
        $response = $this->client->get('/data/3.0/onecall/timemachine', [
            'query' => [
                'lat' => $lat,
                'lon' => $lon,
                'dt' => $timestamp,
                'appid' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
