<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\User;
use App\Models\Favorite;



class FavoriteController extends Controller
{ 
    public function toggle(Request $request)
    {
       
        $request->validate([
            'offer_id' => 'required|exists:offers,id',
        ]);

        $user = Auth::user();
        $offerId = $request->input('offer_id');
        $isFavorited = $user->favorites()->where('offer_id', $offerId)->exists();

        if ($isFavorited) {
            $user->favorites()->detach($offerId);
            return response()->json(['favorited' => false, 'message' => 'Pomyślnie usunięto ofertę z ulubionych.',]);
        } else {
            $user->favorites()->attach($offerId);
            return response()->json(['favorited' => true, 'message' => 'Pomyślnie dodano ofertę do ulubionych.',]);
        }
        
    }

    public static function countFavoritedOffers()
    {
        $userId = Auth::id();
        return Favorite::where('user_id', $userId)
            ->count();
    }
}
