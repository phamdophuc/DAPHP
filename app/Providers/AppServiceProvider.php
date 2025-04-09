<?php

namespace App\Providers;

//use Illuminate\Foundation\Auth\User;
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
        Gate::define('admin', function (?User $user) {
            return $user && optional($user->role)->name === 'admin';
        });
        
        
    }
}
