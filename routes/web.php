<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;


// Glowna strona i informacje
Route::get('/', [WelcomeController::class, 'index'])->name("welcome.index");
Route::view('/terms', 'info.terms')->name('terms');
Route::view('/privacy', 'info.privacy')->name('privacy');

// Panel glowny
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function (){
    Route::get('/offers', [DashboardController::class, 'offers'])->name('offers');
    Route::get('/favorites', [DashboardController::class, 'favorites'])->name('favorites');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/messages', [DashboardController::class, 'messages'])->name('messages');
});

// Oferty
Route::prefix('offers')->name('offers.')->group(function (){
    Route::redirect('/', '/')->name('index');
    Route::post('/', [OfferController::class, 'store'])->name('store');
    Route::get('/create', [OfferController::class, 'create'])->name('create');
    Route::get('/{offer}', [OfferController::class, 'show'])->name('show');
    Route::get('/{offer}/edit', [OfferController::class, 'edit'])->name('edit');
    Route::put('/{offer}', [OfferController::class, 'update'])->name('update');
    Route::delete('/{offer}', [OfferController::class, 'destroy'])->name('destroy');
});

// Wyszukiwanie ofert
Route::get('/search', [OfferController::class, 'search'])->name('offers.search');


// API
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/messages/{user_id}/{receiver_id}/{offer_id}', [MessageController::class, 'getMessages'])->name('messages.getMessages');
    Route::get('/get-models', [WelcomeController::class, 'getModels'])->name('getModels');
});

// Wiadomosci
Route::prefix('offers/{offer_id}/messages/{sender_id}/{receiver_id}')->name('messages.')->group(function () {
    Route::get('/', [MessageController::class, 'show'])->name('show');
    Route::post('/', [MessageController::class, 'store'])->name('store');
});

// Archiwizacja wiadomosci
Route::prefix('messages')->name('messages.')->group(function () {
    Route::patch('/archive/{offerId}/{userId}', [MessageController::class, 'archiveConversation'])->name('archive');
    Route::patch('/restore/{offerId}/{userId}', [MessageController::class, 'restoreConversation'])->name('restore');
});

// Polubione oferty
Route::middleware('auth')->group(function () {
    Route::redirect('/favorite', '/');
    Route::post('/favorite', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
});

// Opinie
Route::middleware('auth')->group(function () {
    Route::post('/reviews', [ReviewController::class, 'add'])->name('reviews.add');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reviews/{seller_id}/edit/{review_id}', [ReviewController::class, 'edit'])->name('reviews.edit');
});
Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.profile');
Route::get('/reviews', [ReviewController::class, 'search'])->name('reviews.sort');

// Profil uzytkownika
Route::middleware('auth')->group(function () {
    Route::redirect('/profile', '/dashboard/profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
