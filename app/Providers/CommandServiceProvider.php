<?php

namespace App\Providers;

use App\Console\Commands\MakeRepositoryCommand;
use App\Console\Commands\MakeServiceCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepositoryCommand::class,
                MakeServiceCommand::class,
            ]);
        }
    }
}
