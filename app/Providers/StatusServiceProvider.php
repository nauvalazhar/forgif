<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class StatusServiceProvider extends ServiceProvider
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
        App::bind('status', function() {
            return new App\Facades\StatusFacade;
        });
    }
}
