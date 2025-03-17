<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\Offer;
use App\Services\CarDataService;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{


    public function index(CarDataService $carDataService)
    {
        $carBrands = CarBrand::all();
        $fuelTypes = $carDataService->getFuelTypes();
        $unreadMsgs = MessageController::countUnreadMessages();
        $favoritedOffers = FavoriteController::countFavoritedOffers();
     

        if (Auth::user()) {
            $userId = Auth::user()->id;
            $offers = Offer::where('user_id', '!=', $userId)->paginate(10);

        } else {
            $offers = Offer::paginate(10);
        }


        foreach ($offers as $offer) {
            if ($offer->carDetails) {
                $offer->carDetails->drive_type_name = $carDataService->getNameBySlug(
                    $carDataService->getDriveTypes(),
                    $offer->carDetails->drive_type
                );
                $offer->carDetails->fuel_type = $carDataService->getNameBySlug(
                    $carDataService->getFuelTypes(),
                    $offer->carDetails->fuel_type
                );
                if ($offer->carDetails->transmission === 'automatic') {
                    $offer->carDetails->transmission = "Automatyczna";
                } else {
                    $offer->carDetails->transmission = "Manualna";
                }
            }
        }

        return view('welcome', compact('offers',  'carBrands', 'fuelTypes', 'unreadMsgs', 'favoritedOffers'));
    }

    public function getModels(Request $request)
    {
        $carBrand = CarBrand::where('slug', $request->slug)->first();
        if (!$carBrand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        $models = $carBrand->carModels;
        return response()->json($models);
    }
}
