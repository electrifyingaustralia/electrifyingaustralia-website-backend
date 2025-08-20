<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\DashboardController;
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

        // ! Admin Users
        Route::controller(AdminController::class)->name('users.')->group(function () {
            Route::get('/users', 'index')->name('all');
            Route::get('/users/create', 'create')->name('create');
            Route::post('/users', 'store')->name('store');
            Route::get('/users/{id}/edit',  'edit')->name('edit');
            Route::put('/users/{id}',  'update')->name('update');
            Route::delete('/users/{id}',  'destroy')->name('delete');
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
    });
});
