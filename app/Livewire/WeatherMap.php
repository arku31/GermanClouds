<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class WeatherMap extends Component
{
    public $cities = [];
    public $dateFrom = '21.01.2024';
    public $dateTo = '21.01.2025';

    public $selectedSeason = 'full';
    
    public function loadCities()
    {
        $response = Http::get(config('app.url') . '/api/weather', [
            'with' => 'aggregations',
            'date_from' => $this->dateFrom,
            'date_to' => $this->dateTo,
        ]);
        
        if ($response->successful()) {
            $this->cities = $response->json()['aggregations']['by_city'];
            $this->dispatch('citiesLoaded', $this->cities, $this->dateFrom, $this->dateTo);
        }
    }

    public function setWinter()
    {
        $this->dateFrom = '01.12.2024';
        $this->dateTo = '28.02.2025';
        $this->loadCities();
        $this->selectedSeason = 'winter';
    }

    public function setSpring()
    {
        $this->dateFrom = '01.03.2024';
        $this->dateTo = '31.05.2024';
        $this->loadCities();
        $this->selectedSeason = 'spring';
    }

    public function setSummer()
    {
        $this->dateFrom = '01.06.2024';
        $this->dateTo = '31.08.2024';
        $this->loadCities();
        $this->selectedSeason = 'summer';
    }

    public function setAutumn()
    {
        $this->dateFrom = '01.09.2024';
        $this->dateTo = '30.11.2024';
        $this->loadCities();
        $this->selectedSeason = 'autumn';
    }

    public function setFullYear()
    {
        $this->dateFrom = '21.01.2024';
        $this->dateTo = '21.01.2025';
        $this->loadCities();
        $this->selectedSeason = 'full';
    }

    public function render()
    {
        return view('livewire.weather-map');
    }
} 