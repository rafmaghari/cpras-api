<?php

namespace App\Providers;

use App\Http\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Http\Contracts\Organization\OrganizationRepositoryInterface;
use App\Http\Contracts\User\UserRepositoryInterface;
use App\Http\Contracts\Vendor\VendorRepositoryInterface;
use App\Http\Repositories\Invoice\InvoiceRepository;
use App\Http\Repositories\Organization\OrganizationRepository;
use App\Http\Repositories\User\UserRepository;
use App\Http\Repositories\Vendor\VendorRepository;
use App\Models\Invoice;
use App\Policies\InvoicePolicy;
use App\Policies\ManageOrganizationPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Invoice::class => InvoicePolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register ManageOrganizationPolicy gates
        Gate::define('viewUsers', [ManageOrganizationPolicy::class, 'viewUsers']);
        Gate::define('addUser', [ManageOrganizationPolicy::class, 'addUser']);
        Gate::define('removeUser', [ManageOrganizationPolicy::class, 'removeUser']);
    }
}
