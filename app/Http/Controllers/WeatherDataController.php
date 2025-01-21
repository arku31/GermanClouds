<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GetWeatherDataService;
use App\Models\City;
use Carbon\Carbon;

class WeatherDataController extends Controller
{
    private GetWeatherDataService $weatherDataService;

    public function __construct(GetWeatherDataService $weatherDataService)
    {
        $this->weatherDataService = $weatherDataService;
    }

    /**
     * Получить данные о погоде для города
     */
    public function show(Request $request, City $city): \Illuminate\Http\JsonResponse
    {
        $dateFrom = $request->get('date_from') ? Carbon::parse($request->get('date_from')) : null;
        $dateTo = $request->get('date_to') ? Carbon::parse($request->get('date_to')) : null;

        $weatherData = $this->weatherDataService->getWeatherDataFromDb([$city->id], $dateFrom, $dateTo);

        return response()->json($weatherData);
    }

    public function getForCities(Request $request): \Illuminate\Http\JsonResponse
    {
        $cityIds = $request->input('cities', []);
        if ($cityIds) {
            $cityIds = explode(',', $cityIds);
        }
        $dateFrom = $request->get('date_from') ? Carbon::parse($request->get('date_from')) : null;
        $dateTo = $request->get('date_to') ? Carbon::parse($request->get('date_to')) : null;

        $weatherData = $this->weatherDataService->getWeatherDataFromDb($cityIds, $dateFrom, $dateTo);

        $withKeys = $request->get('with', 'data,aggregations');
        return response()->json($weatherData->only(explode(',', $withKeys)));
    }
}
