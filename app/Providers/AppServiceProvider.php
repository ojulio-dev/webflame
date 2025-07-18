<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

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

        View::composer(['app.*', 'admin.*', 'layouts.app', 'livewire.*'], function($view) {
            
            $data = [];
            
            $data['globalDataUser']['icon'] = Auth::user()->icon;

            $data['globalDataUser']['name'] = Auth::user()->name;
            
            $data['globalDataUser']['id'] = Auth::user()->id;

            $data['globalDataUser']['isAdmin'] = Auth::user()->isAdmin();

            $view->with('globalDataUser', $data['globalDataUser']);

        });
    }
}
