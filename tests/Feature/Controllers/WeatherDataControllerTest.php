<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\City;
use App\Services\GetWeatherDataService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Models\WeatherData;

class WeatherDataControllerTest extends TestCase
{
    use RefreshDatabase;

    private $weatherDataService;
    private City $city;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->weatherDataService = app(GetWeatherDataService::class);
        $this->city = City::factory()->create();
    }

    public function test_show_returns_weather_data_successfully()
    {
        $dateFrom = '2024-03-20';
        $dateTo = '2024-03-21';

        $sample1 = [
            'city_id' => $this->city->id,
            'date' => $dateFrom,
            'temperature_min' => 20,
            'temperature_max' => 22,
            'cloudiness' => 10
        ];
        $sample2 = [
            'city_id' => $this->city->id,
            'date' => $dateTo,
            'temperature_min' => 21,
            'temperature_max' => 23,
            'cloudiness' => 5
        ];
        WeatherData::factory(2)->createMany([$sample1, $sample2]);
      
        $response = $this->getJson("/api/cities/".$this->city->id."/weather?date_from={$dateFrom}&date_to={$dateTo}");

        $response->assertStatus(200);
        $response->assertJsonFragment($sample1);          
        $response->assertJsonFragment($sample2);
    }

    public function test_show_works_without_dates()
    {
        // Подготовка
        
        $expectedData = [
            ['temperature_min' => 20, 'temperature_max' => 22, 'date' => '2024-03-20']
        ];
        WeatherData::factory()->create([
            'city_id' => $this->city->id,
            'date' => '2024-03-20',
            'temperature_min' => 20,
            'temperature_max' => 22
        ]);

        $response = $this->getJson("/api/cities/".$this->city->id."/weather");

        $response->assertStatus(200)
            ->assertJson($expectedData);
    }
} 