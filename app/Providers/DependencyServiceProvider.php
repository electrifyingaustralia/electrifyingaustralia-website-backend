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
        $repositories = [];

        $services = [];

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
