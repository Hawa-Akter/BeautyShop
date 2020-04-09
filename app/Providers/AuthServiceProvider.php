<?php

namespace BeautyShop\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'BeautyShop\Model' => 'BeautyShop\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gateContract)
    {
        $this->registerPolicies();
        $gateContract->define('isAdmin', function ($user){
            return $user->role == 'admin';

        });
        $gateContract->define('isUser', function ($user){
            return $user->role == 'user';

        });
        $gateContract->define('isBeautitian', function ($user){
            return $user->role == 'beautitian';
        });

    }
}
