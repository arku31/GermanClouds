<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\CityController;
use App\Http\Controllers\WeatherDataController;

Route::get('api/weather', [WeatherDataController::class, 'getForCities']);
if (env('APP_ENV') === 'production') {
    Route::get('api/cities/{city}', [CityController::class, 'show']);
    Route::get('api/cities', [CityController::class, 'index']);
} else {
    Route::apiResource('api/cities', CityController::class);
}
Route::get('api/cities/{city}/weather', [WeatherDataController::class, 'show']);
