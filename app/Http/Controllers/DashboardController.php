<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Favorite;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function offers()
    {
        $user = Auth::user();
        $userName = $user->name;
        $userOffers = Offer::where('user_id', $user->id)
            ->with(['carDetails', 'images', 'messages'])
            ->orderBy('created_at', 'desc')
            ->paginate(2);
        $totalOffers = Offer::where('user_id', $user->id)->count();

        return view('dashboard.offers', compact('userOffers', 'userName', 'totalOffers'));
    }

    public function favorites(){
        $user = Auth::user();
        $userName = $user->name;
        $userOffers = $user->favorites()->with(['carDetails', 'images'])->paginate(2);
        $totalFavorites = $user->favorites()->count();
        return view('dashboard.favorites', compact('userOffers', 'userName', 'totalFavorites'));
    }

    public function profile(){
        $user = Auth::user();
        $userName = $user->name;
        $userRating =   $user->reviewsReceived->avg('rating') ? number_format($user->reviewsReceived->avg('rating'), 2) . '/5' : 'Brak ocen';
        $reviewsCount = $user->reviewsReceived->count();
        return view('dashboard.profile', compact('user', 'userName', 'userRating', 'reviewsCount'));
    }

    public function messages(){
        $user = Auth::user();
        $userName = $user->name;

        $conversations = Message::where('receiver_id', $user->id)
        ->orWhere('sender_id', $user->id)
        ->with(['sender', 'receiver', 'offer.carDetails.carModel.carBrand'])
        ->get()
        ->groupBy(function ($message) use ($user) {
            return $message->offer_id . '-' . ($message->sender_id === $user->id ? $message->receiver_id : $message->sender_id);
        });

        $normalConversations = $conversations->filter(function ($messages) {
            return !$messages->last()->archived;
        })->sortByDesc(function ($messages) {
            return $messages->last()->created_at;
        });

        $archivedConversations = $conversations->filter(function ($messages) {
            return $messages->last()->archived;
        })->sortByDesc(function ($messages) {
            return $messages->last()->created_at;
        });


        return view('dashboard.messages', compact('user', 'userName', 'normalConversations', 'archivedConversations'));
    }
}
