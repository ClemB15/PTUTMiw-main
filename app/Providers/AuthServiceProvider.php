<?php

namespace App\Providers;

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
//         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            return $user->roles->first()->slug == 'admin';
        });

        Gate::define('isModerateur', function ($user) {
            return $user->roles->first()->slug == 'moderateur';
        });

        Gate::define('isResponsableCommerce', function ($user) {
            return $user->roles->first()->slug == 'responsable-commerce';
        });

        Gate::define('isUser', function ($user) {
            return $user->roles->first()->slug == 'user';
        });
    }
}
