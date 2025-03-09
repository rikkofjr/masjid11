<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

// use App\Models\Role;
use App\Models\User;
use App\Models\Zis\JenisZis;
use App\Models\Zis\ZisPenerimaan;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        Permission::class => 'App\Policies\UserSetting\PermissionPolicy',
        Role::class =>'App\Policies\UserSetting\RolePolicy',
        ZisPenerimaan::class =>'App\Policies\ZisSetting\ZisPenerimaanPolicy',
        JenisZis::class =>'App\Policies\ZisSetting\JenisZisPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

    }
}