<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DependencyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $repositories = [
            \App\Repositories\AdminAuth\AdminAuthRepositoryInterface::class => \App\Repositories\AdminAuth\AdminAuthRepository::class,
            \App\Repositories\Team\TeamRepositoryInterface::class => \App\Repositories\Team\TeamRepository::class,
        ];

        $services = [
            \App\Services\AdminAuthService\AdminAuthServiceInterface::class => \App\Services\AdminAuthService\AdminAuthService::class,
            \App\Services\Team\TeamServiceInterface::class => \App\Services\Team\TeamService::class,
            \App\Services\Admin\AdminServiceInterface::class => \App\Services\Admin\AdminService::class,
        ];

        $bindings = array_merge($repositories, $services);

        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
