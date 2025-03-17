<?php

namespace Database\Seeders;

use App\Models\FeatureCategory as ModelsFeatureCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $featureCat = [
            ['slug' => 'audio_and_multimedia', 'category_name' => 'Audio i multimedia'],
            ['slug' => 'comfort_and_accessories', 'category_name' => 'Komfort i dodatki'],
            ['slug' => 'driver_assistance_system', 'category_name' => 'System wspomagania kierowcy'],
        ];

        foreach ($featureCat as $cat) {
            ModelsFeatureCategory::create($cat);
        }
    }
}
