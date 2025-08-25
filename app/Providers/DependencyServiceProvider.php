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
            \App\Repositories\Brand\BrandRepositoryInterface::class => \App\Repositories\Brand\BrandRepository::class,
            \App\Repositories\Contact\ContactRepositoryInterface::class => \App\Repositories\Contact\ContactRepository::class,
            \App\Repositories\Hero\HeroRepositoryInterface::class => \App\Repositories\Hero\HeroRepository::class,
            \App\Repositories\MediaLibrary\MediaLibraryRepositoryInterface::class => \App\Repositories\MediaLibrary\MediaLibraryRepository::class,
        ];

        $services = [
            \App\Services\AdminAuthService\AdminAuthServiceInterface::class => \App\Services\AdminAuthService\AdminAuthService::class,
            \App\Services\Team\TeamServiceInterface::class => \App\Services\Team\TeamService::class,
            \App\Services\Admin\AdminServiceInterface::class => \App\Services\Admin\AdminService::class,
            \App\Services\Brand\BrandServiceInterface::class => \App\Services\Brand\BrandService::class,
            \App\Services\Contact\ContactServiceInterface::class => \App\Services\Contact\ContactService::class,
            \App\Services\Hero\HeroServiceInterface::class => \App\Services\Hero\HeroService::class,
            \App\Services\MediaLibrary\MediaLibraryServiceInterface::class => \App\Services\MediaLibrary\MediaLibraryService::class,
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
