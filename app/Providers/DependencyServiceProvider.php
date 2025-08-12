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
        $bindings = [
            // ^ ===================== Repository ================================
            // \App\Repositories\Admin\AdminRepositoryInterface::class => \App\Repositories\Admin\AdminRepository::class,

            // ^ ===================== Services ===================================
            // \App\Services\User\UserServiceInterface::class => \App\Services\User\UserService::class
        ];

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
