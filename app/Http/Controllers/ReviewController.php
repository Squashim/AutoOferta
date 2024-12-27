<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offer;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class ReviewController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:users,id',
            'rating' => 'required|numeric|in:1,1.5,2,2.5,3,3.5,4,4.5,5',
            'review_text' => 'nullable|string|min:10|max:1000',
        ], [
            'rating.required' => 'Ocena jest wymagana.',
            'rating.numeric' => 'Ocena musi być liczbą.',
            'rating.in' => 'Ocena musi wynosić 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5 lub 5.',
            'review_text.string' => 'Opinia musi być tekstem.',
            'review_text.min' => 'Opinia musi zawierać co najmniej 10 znaków.',
            'review_text.max' => 'Opinia nie może przekraczać 1000 znaków.',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'seller_id' => $request->seller_id,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->back()->with('success', 'Dodano komentarz!');
    }

    public function show($id)
    {
        $user = User::with(['reviewsReceived.user'])->findOrFail($id);

        $reviews = $user->reviewsReceived()->orderBy('created_at', 'desc')->paginate(5);
        $offerCount = Offer::where("user_id", $user->id)->get()->count();

        $isEdit = false;

        return view('reviews.profile', compact('user', 'reviews','offerCount', 'isEdit'));
    }

    public function search(Request $request){
        $userId = $request->userId;
        $validSortOptions = ['newest', 'oldest', 'rating_max', 'rating_min'];
        $sortBy = $request->input('sortBy');
        $offerCount = Offer::where("user_id", $userId)->get()->count();
        $isEdit = false;

        if ($sortBy && !in_array($sortBy, $validSortOptions)) {
            abort(404);
        }

        $user = User::with(['reviewsReceived.user'])->findOrFail($userId);
        $reviewsQuery = $user->reviewsReceived();

        switch ($sortBy) {
            case 'newest':
                $reviewsQuery->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $reviewsQuery->orderBy('created_at', 'asc');
                break;
            case 'rating_max':
                $reviewsQuery->orderBy('rating', 'desc');
                break;
            case 'rating_min':
                $reviewsQuery->orderBy('rating', 'asc');
                break;
            default:
                $reviewsQuery->orderBy('created_at', 'desc');
        }
    
        $reviews = $reviewsQuery->with('user')->paginate(5);


        return view('reviews.profile', compact('user', 'reviews', 'offerCount', 'isEdit'));
    }

    public function update(Request $request, $id){
        $review = Review::findOrfail($id);

        if (Auth::id() !== $review->user_id) {
            return redirect()->route("dashboard.offers");
        }

        $validated = $request->validate([
            'rating' => 'required|numeric|in:1,1.5,2,2.5,3,3.5,4,4.5,5',
            'review_text' => 'nullable|string|min:10|max:1000',
        ], [
            'rating.required' => 'Ocena jest wymagana.',
            'rating.numeric' => 'Ocena musi być liczbą.',
            'rating.in' => 'Ocena musi wynosić 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5 lub 5.',
            'review_text.string' => 'Opinia musi być tekstem.',
            'review_text.min' => 'Opinia musi zawierać co najmniej 10 znaków.',
            'review_text.max' => 'Opinia nie może przekraczać 1000 znaków.',
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'review_text' => $validated['review_text'],
        ]);

        session()->flash('success', 'Zaktualizowano komentarz!');
        return redirect()->route('reviews.profile', [$review->seller_id]);
    }

    public function destroy($id){
        $review = Review::find($id);
        if (Auth::id() !== $review->user_id && Auth::id() !== $review->seller_id) {
            return redirect()->route("reviews.profile', [$review->seller_id]");
        }

        if($review){
            $review->delete();
            return redirect()->route('reviews.profile', [$review->seller_id])->with('success', "Pomyślnie usunięto komentarz.");
        } else {
            return redirect()->route('reviews.profile', [$review->seller_id])->with('error', "Wystąpił błąd podczas usuwania.");
        }
    }

    public function edit($sellerId, $reviewId)
    {
        $review = Review::findOrFail($reviewId);

        if (Auth::id() !== $review->user_id) {
            return redirect()->route("reviews.profile", [$sellerId]);
        }

        $user = User::with(['reviewsReceived.user'])->findOrFail($sellerId);
        $reviews = $user->reviewsReceived()->orderBy('created_at', 'desc')->paginate(5);
        $offerCount = Offer::where("user_id", $user->id)->get()->count();
        $isEdit = true;

        return view('reviews.profile', compact('user', 'offerCount', 'isEdit', 'review', 'reviews'));
    }
}
