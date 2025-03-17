<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(
            [
                CarBrandSeeder::class,
                CarModelSeeder::class,
                FeatureCategory::class,
                FeatureSeeder::class,
                UserSeeder::class,

            ]
        );
    }
}
