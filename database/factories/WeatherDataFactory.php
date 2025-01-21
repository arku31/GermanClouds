<?php

namespace Database\Factories;

use App\Models\WeatherData;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeatherDataFactory extends Factory
{
    protected $model = WeatherData::class;

    public function definition(): array
    {
        return [
            'city_id' => City::factory(),
            'date' => $this->faker->date(),
            'created_at' => now(),
            'updated_at' => now(),
            'temperature_min' => $this->faker->randomFloat(1, -25, 45),
            'temperature_max' => $this->faker->randomFloat(1, -25, 45),
            'cloudiness' => $this->faker->randomFloat(1, 0, 100),
        ];
    }
}
