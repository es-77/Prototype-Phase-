<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create some test services to show in table
        \App\Models\VehicleService::create([
            'ServiceName' => 'Full Engine Diagnostics',
            'VehicleModel' => 'Ford Mustang 2020',
            'ServiceType' => 'Inspection',
            'ServiceAmount' => 120.00,
            'Picture' => null,
        ]);

        \App\Models\VehicleService::create([
            'ServiceName' => 'Brake Pad Replacement',
            'VehicleModel' => 'Honda Civic 2018',
            'ServiceType' => 'Repair',
            'ServiceAmount' => 180.50,
            'Picture' => null,
        ]);
    }
}
