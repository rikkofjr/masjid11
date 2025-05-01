<?php

namespace App\Providers;

use App\Repositories\ProfileMasjidRepositoryInterface;
use App\Repositories\ProfileMasjidRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProfileMasjidRepositoryInterface::class, ProfileMasjidRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
