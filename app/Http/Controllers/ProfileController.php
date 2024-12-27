<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Offer;
use App\Models\OfferImage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('dashboard.profile')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $userOffers = Offer::where('user_id', $user->id)->get();
        

        foreach ($userOffers as $offer) {
            $offerImages = OfferImage::where('offer_id', $offer->id)->get();
            foreach ($offerImages as $image) {
                $imagePath = public_path('storage/' . $image->path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }
    
            // Usuwanie folderu oferty, jeśli istnieje
            $folderPath = public_path('storage/offer_photos/' . $offer->id);
            if (is_dir($folderPath) && count(scandir($folderPath)) == 2) {
                rmdir($folderPath);
            }
    
            // Usuwanie samej oferty
            $offer->delete();
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Użytkownik i wszystkie jego dane zostały pomyślnie usunięte.');
    }
}
