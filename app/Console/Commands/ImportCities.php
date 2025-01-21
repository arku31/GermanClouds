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
    protected $signature = 'app:import-cities';

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

        foreach (self::CITY_NAMES as $cityName) {
            $city = $importCitiesService->importCity($cityName);
            if ($city) {
                $this->info("City $cityName imported successfully");
            } else {
                $this->error("Failed to import city $cityName");
            }
        }
    }
}
