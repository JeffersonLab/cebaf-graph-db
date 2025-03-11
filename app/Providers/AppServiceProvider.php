<?php

namespace App\Providers;

use App\Policies\ConfigPolicy;
use App\Policies\DataSetPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

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
        //

        $this->bootAuth();
        $this->bootRoute();
    }

    public function bootAuth(): void
    {
        // It seems that with livewire 2.x simply having the policies registered
        // isn't enough. We also have to define gates before we can use them
        // in our Components.
        Gate::define('edit-config', [ConfigPolicy::class, 'update']);
        Gate::define('create-config', [ConfigPolicy::class, 'create']);
        Gate::define('edit-data-set', [DataSetPolicy::class, 'update']);
        Gate::define('create-data-set', [DataSetPolicy::class, 'create']);
    }

    public function bootRoute(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });


    }
}
