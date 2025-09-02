<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\MediaLibraryController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\StickyHeaderController;
use App\Http\Controllers\Backend\TeamController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


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
        });

        // ! Sticky Header
        Route::controller(StickyHeaderController::class)->name('sticky-header.')->group(function () {
            Route::get('/sticky-header', 'index')->name('all');
            Route::post('/sticky-header', 'store')->name('store');
            Route::get('/sticky-header/{id}/edit',  'edit')->name('edit');
            Route::put('/sticky-header/{id}',  'update')->name('update');
            Route::delete('/sticky-header/{id}',  'destroy')->name('delete');
        });

        // ! Blog
        Route::controller(BlogController::class)->name('blog.')->group(function () {
            Route::get('/blog', 'index')->name('all');
            Route::get('/blog/create', 'create')->name('create');
            Route::post('/blog', 'store')->name('store');
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
            Route::delete('/teams/{id}',  'destroy')->name('delete');
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
    });
});
