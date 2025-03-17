<?php

namespace Database\Seeders;

use App\Models\CarDetail;
use App\Models\Feature;
use App\Models\FeatureCategory;
use App\Models\Offer;
use App\Models\OfferImage;
use App\Models\User;
use App\Services\CarDataService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{

    protected $carDataService;

    public function __construct(CarDataService $carDataService)
    {
        $this->carDataService = $carDataService;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
    }
}
