<?php

namespace App\Services;

use App\Models\CarBrand;

class CarDataService
{
    public function getFuelTypes()
    {
        return collect([
            (object) ['slug' => 'benzyne', 'name' => 'Benzyna'],
            (object) ['slug' => 'benzyne_cng', 'name' => 'Benzyna+CNG'],
            (object) ['slug' => 'benzyne_lpg', 'name' => 'Benzyna+LPG'],
            (object) ['slug' => 'diesel', 'name' => 'Diesel'],
            (object) ['slug' => 'electric', 'name' => 'Elektryczny'],
            (object) ['slug' => 'ethanol', 'name' => 'Etanol'],
            (object) ['slug' => 'hybrid', 'name' => 'Hybryda'],
            (object) ['slug' => 'hydrogen', 'name' => 'Wodór'],
        ]);
    }

    public function getDriveTypes()
    {
        return collect([
            (object) ['slug' => 'fwd', 'name' => 'Napęd na przednie koła (FWD)'],
            (object) ['slug' => 'rwd', 'name' => 'Napęd na tylne koła (RWD)'],
            (object) ['slug' => 'awd', 'name' => 'Napęd na wszystkie koła (AWD)'],
            (object) ['slug' => '4wd', 'name' => 'Napęd na cztery koła (4WD)'],
            (object) ['slug' => 'electric', 'name' => 'Napęd elektryczny'],
            (object) ['slug' => 'hybrid', 'name' => 'Napęd hybrydowy'],
        ]);
    }

    public function getVehicleConditions()
    {
        return collect([
            (object) ['slug' => 'new', 'name' => 'Nowy'],
            (object) ['slug' => 'used', 'name' => 'Używany'],
            (object) ['slug' => 'damaged', 'name' => 'Uszkodzony'],
            (object) ['slug' => 'after_accident', 'name' => 'Powypadkowy'],
            (object) ['slug' => 'imported', 'name' => 'Sprowadzony'],
        ]);
    }

    public function getCarTypes()
    {
        return collect([
            (object) ['slug' => 'small', 'name' => 'Małe'],
            (object) ['slug' => 'city', 'name' => 'Miejskie'],
            (object) ['slug' => 'compact', 'name' => 'Kompakt'],
            (object) ['slug' => 'sedan', 'name' => 'Sedan'],
            (object) ['slug' => 'kombi', 'name' => 'Kombi'],
            (object) ['slug' => 'minivan', 'name' => 'Minivan'],
            (object) ['slug' => 'suv', 'name' => 'SUV'],
            (object) ['slug' => 'cabrio', 'name' => 'Kabriolet'],
            (object) ['slug' => 'coupe', 'name' => 'Coupe'],
        ]);
    }

    public function getNameBySlug($collection, $slug)
    {
        return $collection->firstWhere('slug', $slug)->name ?? 'N/A';
    }
}
