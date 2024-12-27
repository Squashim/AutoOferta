<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FavoriteController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $unreadMsgs = MessageController::countUnreadMessages();
            $favoritedOffers = FavoriteController::countFavoritedOffers();
            $view->with('unreadMsgs', $unreadMsgs)->with('favoritedOffers', $favoritedOffers);
        });
    }
}
