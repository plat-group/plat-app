<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use App\Models\GameTemplate;
use App\Policies\GameTemplatePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         GameTemplate::class => GameTemplatePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('near', function ($app, array $config) {
            return new NearUserProvider($this->app['hash'], $config['model']);
        });
    }
}
