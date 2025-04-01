<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
        Gate::define('manage', function (?User $user) {
            return $user && $user->role === 'admin';
        });
        Gate::define('admin', function (?User $user) {
            return $user && $user->role === 'admin';
        });
        Gate::define('is-admin', function (?User $user) {
            return $user && $user->role === 'admin';
        });
    }
}
