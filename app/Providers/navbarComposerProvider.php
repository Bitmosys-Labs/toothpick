<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class navbarComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeNavbar();
    }

    public function composeNavbar(){
        view()->composer('frontend.includes.header', 'App\Http\Composers\navbarComposer');
    }
}
