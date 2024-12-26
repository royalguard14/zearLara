<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         // Developer Directive
    Blade::if('developer', function () {
        return Auth::check() && Auth::user()->role->role_name == 'Developer';
    });

    // User Directive
    Blade::if('user', function () {
        return Auth::check() && Auth::user()->role->role_name == 'User';
    });

    
    }
}
