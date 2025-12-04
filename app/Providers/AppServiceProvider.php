<?php

namespace App\Providers;

use App\Http\Contracts\Organization\OrganizationRepositoryInterface;
use App\Http\Contracts\User\UserRepositoryInterface;
use App\Http\Repositories\Organization\OrganizationRepository;
use App\Http\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
