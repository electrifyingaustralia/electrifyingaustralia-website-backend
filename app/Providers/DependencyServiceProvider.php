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
            \App\Repositories\Award\AwardRepositoryInterface::class => \App\Repositories\Award\AwardRepository::class,
            \App\Repositories\Benefit\BenefitRepositoryInterface::class => \App\Repositories\Benefit\BenefitRepository::class,
            \App\Repositories\Blog\BlogRepositoryInterface::class => \App\Repositories\Blog\BlogRepository::class,
            \App\Repositories\Event\EventRepositoryInterface::class => \App\Repositories\Event\EventRepository::class,
            \App\Repositories\Faq\FaqRepositoryInterface::class => \App\Repositories\Faq\FaqRepository::class,
            \App\Repositories\Project\ProjectRepositoryInterface::class => \App\Repositories\Project\ProjectRepository::class,
            \App\Repositories\Review\ReviewRepositoryInterface::class => \App\Repositories\Review\ReviewRepository::class,
            \App\Repositories\Solution\SolutionRepositoryInterface::class => \App\Repositories\Solution\SolutionRepository::class,
            \App\Repositories\StickyHeader\StickyHeaderRepositoryInterface::class => \App\Repositories\StickyHeader\StickyHeaderRepository::class,
            \App\Repositories\Package\PackageRepositoryInterface::class => \App\Repositories\Package\PackageRepository::class,
            \App\Repositories\SolutionCard\SolutionCardRepositoryInterface::class => \App\Repositories\SolutionCard\SolutionCardRepository::class,
        ];

        $services = [
            \App\Services\AdminAuthService\AdminAuthServiceInterface::class => \App\Services\AdminAuthService\AdminAuthService::class,
            \App\Services\Team\TeamServiceInterface::class => \App\Services\Team\TeamService::class,
            \App\Services\Admin\AdminServiceInterface::class => \App\Services\Admin\AdminService::class,
            \App\Services\Brand\BrandServiceInterface::class => \App\Services\Brand\BrandService::class,
            \App\Services\Contact\ContactServiceInterface::class => \App\Services\Contact\ContactService::class,
            \App\Services\Hero\HeroServiceInterface::class => \App\Services\Hero\HeroService::class,
            \App\Services\MediaLibrary\MediaLibraryServiceInterface::class => \App\Services\MediaLibrary\MediaLibraryService::class,
            \App\Services\Award\AwardServiceInterface::class => \App\Services\Award\AwardService::class,
            \App\Services\Benefit\BenefitServiceInterface::class => \App\Services\Benefit\BenefitService::class,
            \App\Services\Blog\BlogServiceInterface::class => \App\Services\Blog\BlogService::class,
            \App\Services\Event\EventServiceInterface::class => \App\Services\Event\EventService::class,
            \App\Services\Faq\FaqServiceInterface::class => \App\Services\Faq\FaqService::class,
            \App\Services\Project\ProjectServiceInterface::class => \App\Services\Project\ProjectService::class,
            \App\Services\Review\ReviewServiceInterface::class => \App\Services\Review\ReviewService::class,
            \App\Services\Solution\SolutionServiceInterface::class => \App\Services\Solution\SolutionService::class,
            \App\Services\StickyHeader\StickyHeaderServiceInterface::class => \App\Services\StickyHeader\StickyHeaderService::class,
            \App\Services\Package\PackageServiceInterface::class => \App\Services\Package\PackageService::class,
            \App\Services\SolutionCard\SolutionCardServiceInterface::class => \App\Services\SolutionCard\SolutionCardService::class,
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
