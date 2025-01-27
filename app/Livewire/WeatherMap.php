<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class WeatherMap extends Component
{
    public $cities = [];
    
    public function loadCities()
    {
        $response = Http::get(config('app.url') . '/api/weather');
        if ($response->successful()) {
            $this->cities = $response->json()['aggregations']['by_city'];
            $this->dispatch('citiesLoaded', $this->cities);
        }
    }

    public function render()
    {
        return view('livewire.weather-map');
    }
} 