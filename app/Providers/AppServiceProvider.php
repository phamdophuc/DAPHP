<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('manage', function ($user) {
            return $user->role === 'admin'; // Chỉ cho phép admin
        });
    
        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });
    
        Gate::define('is-user', function ($user) {
            return $user->role === 'user';
        });
    }
}
