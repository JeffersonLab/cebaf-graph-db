<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Config;
use App\Models\DataSet;
use App\Policies\ConfigPolicy;
use App\Policies\DataSetPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Config::class => ConfigPolicy::class,
        DataSet::class => DataSetPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // It seems that with livewire 2.x simply having the policies registered
        // isn't enough. We also have to define gates before we can use them
        // in our Components.
        Gate::define('edit-config', [ConfigPolicy::class, 'update']);
        Gate::define('create-config', [ConfigPolicy::class, 'create']);
        Gate::define('edit-data-set', [DataSetPolicy::class, 'update']);
        Gate::define('create-data-set', [DataSetPolicy::class, 'create']);
    }
}
