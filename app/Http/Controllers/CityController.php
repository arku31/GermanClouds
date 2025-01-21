<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CityController extends Controller
{
    /**
     * Получить список всех городов
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $cities = City::all();
        return response()->json($cities);
    }

    /**
     * Сохранить новый город
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_code' => 'required|string|size:2',
            'lat' => 'required|numeric|between:-90,90',
            'lon' => 'required|numeric|between:-180,180'
        ]);

        $city = City::create($validated);
        return response()->json($city, 201);
    }

    /**
     * Получить конкретный город
     */
    public function show(City $city): \Illuminate\Http\JsonResponse
    {
        return response()->json($city);
    }

    /**
     * Обновить существующий город
     */
    public function update(Request $request, City $city): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'country_code' => 'sometimes|string|size:2',
            'lat' => 'sometimes|numeric|between:-90,90',
            'lon' => 'sometimes|numeric|between:-180,180'
        ]);

        $city->update($validated);
        return response()->json($city);
    }

    /**
     * Удалить город
     */
    public function destroy(City $city): \Illuminate\Http\JsonResponse
    {
        $city->delete();
        return response()->json(null, 204);
    }
}
