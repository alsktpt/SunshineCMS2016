<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        // 权限policy初始化
        
        $permissions = \App\Permission::with('roles')->get();
        foreach ($permissions as $permission) {
            $gate->define($permission->name, function($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }

        $gate->define('is-post-owner', function ($user, $post) {
            return $user->id === $post->user_id;
        });
    }
}
