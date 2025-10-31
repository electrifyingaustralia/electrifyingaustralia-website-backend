<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BenefitController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\FaqTypeController;
use App\Http\Controllers\Backend\HeroController;
use App\Http\Controllers\Backend\MediaLibraryController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductTypeController;
use App\Http\Controllers\Backend\ProjectCategoryController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\ProjectTypeController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\QuotationController;
// use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SolutionCardController;
use App\Http\Controllers\Backend\StickyHeaderController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\SettingOptionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/login');


Route::prefix('admin')->name('admin.')->group(function () {

    // !Login & Logout
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login.post');
        Route::post('/logout', 'logout')->middleware('admin.auth')->name('logout');
    });


    Route::middleware('admin.auth')->group(function () {

        // ! Dashboard
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
        });

        // ! Media Library
        Route::controller(MediaLibraryController::class)->name('media.')->group(function () {
            Route::get('/media', 'index')->name('all');
            Route::get('/media/ajax', 'ajaxIndex')->name('ajax.all');
            Route::post('/media', 'store')->name('store');
            Route::put('/media/{id}',  'update')->name('update');
            Route::delete('/media/{id}', 'destroy')->name('destroy');
        });

        // ! Admin Users
        Route::controller(AdminController::class)->name('users.')->group(function () {
            Route::get('/users', 'index')->name('all');
            Route::get('/users/create', 'create')->name('create');
            Route::post('/users', 'store')->name('store');
            Route::get('/users/{id}/edit',  'edit')->name('edit');
            Route::put('/users/{id}',  'update')->name('update');
            Route::delete('/users/{id}',  'destroy')->name('delete');
            Route::get('/change-password', 'showChangePassword')->name('change-password');
            Route::post('/update-password', 'updatePassword')->name('update-password');
        });

        // ! Sticky Header
        Route::controller(StickyHeaderController::class)->name('sticky-header.')->group(function () {
            Route::get('/sticky-header', 'index')->name('all');
            Route::post('/sticky-header', 'store')->name('store');
            Route::get('/sticky-header/{id}/edit',  'edit')->name('edit');
            Route::put('/sticky-header/{id}',  'update')->name('update');
            Route::delete('/sticky-header/{id}',  'destroy')->name('delete');
        });

        // ! Blog-Category
        Route::controller(BlogCategoryController::class)->name('blog-category.')->group(function () {
            Route::get('/blog-category', 'index')->name('all');
            Route::post('/blog-category', 'store')->name('store');
            Route::get('/blog-category/{id}/edit',  'edit')->name('edit');
            Route::put('/blog-category/{id}',  'update')->name('update');
            Route::delete('/blog-category/{id}',  'destroy')->name('delete');
        });

        // ! Blog
        Route::controller(BlogController::class)->name('blog.')->group(function () {
            Route::get('/blog', 'index')->name('all');
            Route::get('/blog/create', 'create')->name('create');
            Route::post('/blog', 'store')->name('store');
            Route::get('/blog/{id}',  'show')->name('show');
            Route::get('/blog/{id}/edit',  'edit')->name('edit');
            Route::put('/blog/{id}',  'update')->name('update');
            Route::delete('/blog/{id}',  'destroy')->name('delete');
        });

        // ! Brands
        Route::controller(BrandController::class)->name('brands.')->group(function () {
            Route::get('/brands', 'index')->name('all');
            Route::get('/brands/create', 'create')->name('create');
            Route::post('/brands', 'store')->name('store');
            Route::get('/brands/{id}/edit',  'edit')->name('edit');
            Route::put('/brands/{id}',  'update')->name('update');
            Route::delete('/brands/{id}',  'destroy')->name('delete');
        });

        // ! Teams
        Route::controller(TeamController::class)->name('teams.')->group(function () {
            Route::get('/teams', 'index')->name('all');
            Route::get('/teams/create', 'create')->name('create');
            Route::post('/teams', 'store')->name('store');
            Route::get('/teams/{id}/edit',  'edit')->name('edit');
            Route::put('/teams/{id}',  'update')->name('update');
            Route::post('/teams/update-order', 'updateOrder')->name('update-order');
            Route::delete('/teams/{id}',  'destroy')->name('delete');
        });

        // ! FAQ-Type
        Route::controller(FaqTypeController::class)->name('faq-type.')->group(function () {
            Route::get('/faq-type', 'index')->name('all');
            Route::post('/faq-type', 'store')->name('store');
            Route::get('/faq-type/{id}/edit',  'edit')->name('edit');
            Route::put('/faq-type/{id}',  'update')->name('update');
            Route::delete('/faq-type/{id}',  'destroy')->name('delete');
        });

        // ! FAQ
        Route::controller(FaqController::class)->name('faq.')->group(function () {
            Route::get('/faq', 'index')->name('all');
            Route::post('/faq', 'store')->name('store');
            Route::get('/faq/{id}/edit',  'edit')->name('edit');
            Route::get('/faq/{id}',  'show')->name('show');
            Route::put('/faq/{id}',  'update')->name('update');
            Route::delete('/faq/{id}',  'destroy')->name('delete');
        });

        // ! Event
        Route::controller(EventController::class)->name('event.')->group(function () {
            Route::get('/event', 'index')->name('all');
            Route::get('/event/create', 'create')->name('create');
            Route::post('/event', 'store')->name('store');
            Route::get('/event/{id}/edit',  'edit')->name('edit');
            Route::get('/event/{id}',  'show')->name('show');
            Route::put('/event/{id}',  'update')->name('update');
            Route::delete('/event/{id}',  'destroy')->name('delete');

            Route::get('events/{id}/assign-images',  'assignImages')->name('assign-images');
            Route::post('events/{id}/store-images',  'storeImages')->name('store-images');
            Route::get('events/{id}/images',  'getEventImages')->name('images');
        });

        // ! Project-Type
        Route::controller(ProjectTypeController::class)->name('project-type.')->group(function () {
            Route::get('/project-type', 'index')->name('all');
            Route::post('/project-type', 'store')->name('store');
            Route::get('/project-type/{id}/edit',  'edit')->name('edit');
            Route::put('/project-type/{id}',  'update')->name('update');
            Route::delete('/project-type/{id}',  'destroy')->name('delete');
        });

        // ! Project-Category
        Route::controller(ProjectCategoryController::class)->name('project-category.')->group(function () {
            Route::get('/project-category', 'index')->name('all');
            Route::post('/project-category', 'store')->name('store');
            Route::get('/project-category/{id}/edit',  'edit')->name('edit');
            Route::put('/project-category/{id}',  'update')->name('update');
            Route::delete('/project-category/{id}',  'destroy')->name('delete');
        });

        // ! Project
        Route::controller(ProjectController::class)->name('project.')->group(function () {
            Route::get('/project', 'index')->name('all');
            Route::get('/project/create', 'create')->name('create');
            Route::post('/project', 'store')->name('store');
            Route::get('/project/{id}/edit',  'edit')->name('edit');
            Route::get('/project/{id}',  'show')->name('show');
            Route::put('/project/{id}',  'update')->name('update');
            Route::delete('/project/{id}',  'destroy')->name('delete');

            Route::get('/project/{id}/assign-images',  'assignImages')->name('assign-images');
            Route::post('/project/{id}/store-images',  'storeImages')->name('store-images');
            Route::get('/project/{id}/images',  'getProjectImages')->name('images');
        });

        // ! Package
        Route::controller(PackageController::class)->name('package.')->group(function () {
            Route::get('/package', 'index')->name('all');
            Route::get('/package/create', 'create')->name('create');
            Route::post('/package', 'store')->name('store');
            Route::get('/package/{id}/edit',  'edit')->name('edit');
            Route::get('/package/{id}',  'show')->name('show');
            Route::put('/package/{id}',  'update')->name('update');
            Route::delete('/package/{id}',  'destroy')->name('delete');
        });

        // ! Benefits
        Route::controller(BenefitController::class)->name('benefit.')->group(function () {
            Route::get('/benefit', 'index')->name('all');
            Route::get('/benefit/create', 'create')->name('create');
            Route::post('/benefit', 'store')->name('store');
            Route::get('/benefit/{id}/edit',  'edit')->name('edit');
            Route::get('/benefit/{id}',  'show')->name('show');
            Route::put('/benefit/{id}',  'update')->name('update');
            Route::delete('/benefit/{id}',  'destroy')->name('delete');
        });

        // ! Solution Cards
        Route::controller(SolutionCardController::class)->name('solution-card.')->group(function () {
            Route::get('/solution-card', 'index')->name('all');
            Route::post('/solution-card', 'store')->name('store');
            Route::get('/solution-card/{id}/edit',  'edit')->name('edit');
            Route::get('/solution-card/{id}',  'show')->name('show');
            Route::put('/solution-card/{id}',  'update')->name('update');
            Route::delete('/solution-card/{id}',  'destroy')->name('delete');
        });

        // ! Product-Type
        Route::controller(ProductTypeController::class)->name('product-type.')->group(function () {
            Route::get('/product-type', 'index')->name('all');
            Route::post('/product-type', 'store')->name('store');
            Route::get('/product-type/{id}/edit',  'edit')->name('edit');
            Route::put('/product-type/{id}',  'update')->name('update');
            Route::delete('/product-type/{id}',  'destroy')->name('delete');
        });

        // ! Products
        Route::controller(ProductController::class)->name('product.')->group(function () {
            Route::get('/product', 'index')->name('all');
            Route::get('/product/create', 'create')->name('create');
            Route::post('/product', 'store')->name('store');
            Route::get('/product/{id}/edit',  'edit')->name('edit');
            Route::get('/product/{id}',  'show')->name('show');
            Route::put('/product/{id}',  'update')->name('update');
            Route::delete('/product/{id}',  'destroy')->name('delete');
        });

        // // ! Settings
        // Route::controller(SettingController::class)->name('setting.')->group(function () {
        //     Route::get('/setting', 'index')->name('all');
        //     Route::get('/setting/create', 'create')->name('create');
        //     Route::post('/setting', 'store')->name('store');
        //     Route::get('/setting/{id}/edit',  'edit')->name('edit');
        //     Route::get('/setting/{id}',  'show')->name('show');
        //     Route::put('/setting/{id}',  'update')->name('update');
        //     Route::delete('/setting/{id}',  'destroy')->name('delete');
        // });

        // ! Quotation
        Route::controller(QuotationController::class)->name('quotation.')->group(function () {
            Route::get('/quotation', 'index')->name('all');
            Route::get('/quotation/create', 'create')->name('create');
            Route::post('/quotation', 'store')->name('store');
            Route::get('/quotation/{id}/edit',  'edit')->name('edit');
            Route::get('/quotation/{id}',  'show')->name('show');
            Route::put('/quotation/{id}',  'update')->name('update');
            Route::delete('/quotation/{id}',  'destroy')->name('delete');
            Route::get('quotation/{id}/assign-questions', 'showAssignQuestions')->name('show.assign-questions');
            Route::post('quotation/{id}/assign-questions', 'assignQuestions')->name('assign-questions');
            Route::delete('quotation/{sectionId}/remove-question/{questionId}', 'removeQuestion')->name('remove-question');
            Route::post('quotation/{id}/update-question-order', 'updateQuestionOrder')->name('update-question-order');
        });

        // ! Question
        Route::controller(QuestionController::class)->name('question.')->group(function () {
            Route::get('/question', 'index')->name('all');
            Route::get('/question/create', 'create')->name('create');
            Route::post('/question', 'store')->name('store');
            Route::get('/question/{id}/edit',  'edit')->name('edit');
            Route::get('/question/{id}',  'show')->name('show');
            Route::put('/question/{id}',  'update')->name('update');
            Route::delete('/question/{id}',  'destroy')->name('delete');
        });

        // ! Hero
        Route::controller(HeroController::class)->name('hero.')->group(function () {
            Route::get('/hero', 'index')->name('all');
            Route::get('/hero/create', 'create')->name('create');
            Route::post('/hero', 'store')->name('store');
            Route::get('/hero/{id}/edit',  'edit')->name('edit');
            Route::get('/hero/{id}',  'show')->name('show');
            Route::put('/hero/{id}',  'update')->name('update');
            Route::delete('/hero/{id}',  'destroy')->name('delete');
        });

        // ! Customer
        Route::controller(CustomerController::class)->name('customer.')->group(function () {
            Route::get('/customers', 'index')->name('all');
            Route::get('/customers/{customer}', 'show')->name('show');
            Route::put('/customers/{customer}', 'update')->name('update');
            Route::delete('/customers/{customer}', 'destroy')->name('delete');
        });

        // ! Settings
        Route::controller(SettingOptionController::class)->name('settings.')->group(function () {
            Route::get('/settings', 'index')->name('all');
            Route::post('/settings/update', 'update')->name('update');
        });
    });
});
