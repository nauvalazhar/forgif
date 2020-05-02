<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class FriendsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('friends', function() {
            return new App\Facades\FriendsFacade;
        });
    }
}
