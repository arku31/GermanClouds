<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\CityController;
use App\Http\Controllers\WeatherDataController;

Route::get('api/weather', [WeatherDataController::class, 'getForCities']);
Route::apiResource('api/cities', CityController::class);

Route::get('api/cities/{city}/weather', [WeatherDataController::class, 'show']);