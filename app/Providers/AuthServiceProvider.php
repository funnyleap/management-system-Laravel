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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 開発者のみ許可
        Gate::define('developer', function ($user) {
            return ($user->role == 1);
        });
        // 管理者以上（管理者＆開発者）に許可
        Gate::define('admin', function ($user) {
            return ($user->role <= 2);
        });
        // ユーザのみに許可
        Gate::define('user', function ($user) {
            return ($user->role == 3);
        });
        // 全てに許可
        Gate::define('all', function ($user) {
            return ($user->role <= 3);
        });
    }
}
