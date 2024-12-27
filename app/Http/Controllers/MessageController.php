<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CarDataService;
use App\Models\Favorite;
use App\Models\Offer;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class MessageController  extends Controller
{

    protected $carDataService;


    public function __construct(CarDataService $carDataService)
    {
        $this->carDataService = $carDataService;
        $this->middleware(['auth', 'verified'])->except('show', 'search');
    }

    public function show($offerId, $userId){
        $offer = Offer::find($offerId);
        $isFavorited = "";
        $message = True;
        $userRating =   $offer->user->reviewsReceived->avg('rating') ? number_format($offer->user->reviewsReceived->avg('rating'), 2) . '/5' : 'Brak ocen';

        if (!$offer) {
            abort(404, 'Nie znaleziono takiej oferty!');
        }

        if (Auth::user()) {
            $userId = Auth::user()->id;
            $isFavorited = Favorite::where('user_id', $userId)->first();
        }

        $offer->carDetails->car_condition = $this->carDataService->getNameBySlug(
            $this->carDataService->getVehicleConditions(),
            $offer->carDetails->car_condition
        );
        $offer->carDetails->fuel_type = $this->carDataService->getNameBySlug(
            $this->carDataService->getFuelTypes(),
            $offer->carDetails->fuel_type
        );
        $offer->carDetails->car_type = $this->carDataService->getNameBySlug(
            $this->carDataService->getCarTypes(),
            $offer->carDetails->car_type
        );

        $offer->carDetails->drive_type = $this->carDataService->getNameBySlug(
            $this->carDataService->getDriveTypes(),
            $offer->carDetails->drive_type
        );


        if ($offer->carDetails->transmission == 'automatic') {
            $offer->carDetails->transmission =  "Automatyczna";
        } else {
            $offer->carDetails->transmission = "Manualna";
        }

        $features = $offer->carDetails->features()->with('category')->get()->groupBy('category.category_name');

        return view('offers.show', compact("offer", "features", "isFavorited", "message", "userId", "userRating"));
    }

    public static function countUnreadMessages()
    {
        $userId = Auth::id();
        return Message::where('receiver_id', $userId)
            ->where('read', false)
            ->count();
    }

    public function store(Request $request, $offerId, $senderId, $receiverId, $dashboard = False)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000|min:10',
        ], [
            'message.required' => 'Wiadomość jest wymagana.',
            'message.string' => "Wiadomość musi być tekstem.",
            'message.max' => "Wiadomość może mieć maksymalnie 1000 znaków.",
            'message.min' => "Wiadomość musi mieć minimum 10 znaków.",
        ]);

        $dashboard = $request->input('dashboard', false);

        Message::create([
            'receiver_id' => $receiverId,
            'sender_id' => $senderId,
            'offer_id' => $offerId,
            'message' => $validated['message'],
        ]);

        if($dashboard){
            $user = Auth::user();
            $userName = $user->name;
        
            $conversations = Message::where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)
            ->with(['sender', 'receiver', 'offer.carDetails.carModel.carBrand'])
            ->get()
            ->groupBy(function ($message) use ($user) {
                return $message->offer_id . '-' . ($message->sender_id === $user->id ? $message->receiver_id : $message->sender_id);
            });
            return redirect()->route('dashboard.messages')->with([
                'success' => 'Wiadomość została wysłana!',
                'user' => $user,
                'userName' => $userName,
                'conversations' => $conversations
            ]);
        }

        return redirect()->route('offers.show', $offerId)->with('success', 'Wiadomość została wysłana!');
    }

    public function getMessages($userId, $receiverId, $offerId)
    {
        $messages = Message::where(function ($query) use ($userId, $receiverId, $offerId) {
            $query->where('receiver_id', $userId)
                  ->where('sender_id', $receiverId)
                  ->where('offer_id', $offerId);
        })
        ->orWhere(function ($query) use ($userId, $receiverId, $offerId) {
            $query->where('receiver_id', $receiverId)
                  ->where('sender_id', $userId)
                  ->where('offer_id', $offerId);
        })
        ->with(['sender', 'receiver'])
        ->get();

        foreach($messages as $message){
            if($message->receiver_id == $userId && !$message->read){
                $message->read = true;
                $message->save();
            }
        }

        return response()->json($messages);
    }

    public function archiveConversation($offerId, $userId)
    {
        $messages = Message::where('offer_id', $offerId)
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->update(['archived' => true]);

        return redirect()->route('dashboard.messages')->with('success', 'Konwersacja została przeniesiona do archiwum.');
    }

    public function restoreConversation($offerId, $userId)
    {
        $messages = Message::where('offer_id', $offerId)
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->update(['archived' => false]);

        return redirect()->route('dashboard.messages')->with('success', 'Konwersacja została przywrócona.');
    }
}
