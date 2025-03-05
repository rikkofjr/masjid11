<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\UserSetting\UserPolicy;
use App\Models\User;
use App\Policies\Usersetting\PermissionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        //'App\Models\User::class' => 'App\Policies\UserSetting\UserPolicy::class',
        User::class => 'App\Policies\UserSetting\UserPolicy',
        Permission::class => 'App\Policies\Usersetting\PermissionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}