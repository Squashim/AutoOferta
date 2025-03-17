<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarBrand;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carBrands = [
            ['name' => 'Toyota', 'slug' => 'toyota'],
            ['name' => 'Volkswagen', 'slug' => 'volkswagen'],
            ['name' => 'BMW', 'slug' => 'bmw'],
            ['name' => 'Mercedes-Benz', 'slug' => 'mercedes-benz'],
            ['name' => 'Honda', 'slug' => 'honda'],
            ['name' => 'Ford', 'slug' => 'ford'],
            ['name' => 'Audi', 'slug' => 'audi'],
            ['name' => 'Peugeot', 'slug' => 'peugeot'],
            ['name' => 'Hyundai', 'slug' => 'hyundai'],
            ['name' => 'Nissan', 'slug' => 'nissan'],
            ['name' => 'Opel', 'slug' => 'opel'],
            ['name' => 'Kia', 'slug' => 'kia'],
            ['name' => 'Skoda', 'slug' => 'skoda'],
            ['name' => 'Mazda', 'slug' => 'mazda'],
            ['name' => 'Renault', 'slug' => 'renault'],
        ];

        foreach ($carBrands as $brand) {
            CarBrand::create($brand);
        }
    }
}
