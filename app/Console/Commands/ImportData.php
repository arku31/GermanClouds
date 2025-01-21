<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImportDataService;
use App\Models\City;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dataService = app(ImportDataService::class);
        $cities = City::all();
        $this->info("Importing weather data for {$cities->count()} cities");
        foreach ($cities as $city) {
            $dataService->importWeatherData($city);
            $this->info("Imported weather data for {$city->name}");
        }
    }
}
