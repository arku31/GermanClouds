<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImportCitiesService;

class ImportCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-cities {--cities=default : Comma separated list of city IDs or names, or "default"}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public const CITY_NAMES = ['Freiburg', 'Hamburg', "Lübeck", "Berlin", "Munich", "Düsseldorf", "Frankfurt", "Stuttgart", "Leipzig", "Dresden"];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $importCitiesService = app(ImportCitiesService::class);
        $cities = $this->option('cities') === 'default'
            ? self::CITY_NAMES
            : explode(',', $this->option('cities'));

        foreach ($cities as $cityName) {
            $city = $importCitiesService->importCityIfNotExists($cityName);
            if ($city === null) {
                $this->error("Failed to import city $cityName");
                continue;
            }

            if ($city->wasRecentlyCreated) {
                $this->info("City $cityName imported successfully");
            } else {
                $this->info("City $cityName already exists");
            }
        }
    }
}
