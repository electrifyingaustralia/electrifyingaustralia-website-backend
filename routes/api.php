<?php

use App\Http\Controllers\Api\ApiBenefitController;
use App\Http\Controllers\Api\ApiBlogController;
use App\Http\Controllers\Api\ApiBrandController;
use App\Http\Controllers\Api\ApiEventController;
use App\Http\Controllers\Api\ApiFaqController;
use App\Http\Controllers\Api\ApiHeroController;
use App\Http\Controllers\Api\ApiPackageController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiProjectController;
use App\Http\Controllers\Api\ApiQuotationController;
use App\Http\Controllers\Api\ApiSolutionCardController;
use App\Http\Controllers\Api\ApiStickyHeaderController;
use App\Http\Controllers\Api\ApiTeamController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // ! Heroes
    Route::controller(ApiHeroController::class)->group(function () {});
    Route::get('heroes', [ApiHeroController::class, 'index']);

    // ! Brands
    Route::controller(ApiBrandController::class)->group(function () {});
    Route::get('brands', [ApiBrandController::class, 'index']);

    // ! Products
    Route::controller(ApiProductController::class)->group(function () {});
    Route::get('products', [ApiProductController::class, 'index']);

    // ! Benefits
    Route::controller(ApiBenefitController::class)->group(function () {});
    Route::get('benefits', [ApiBenefitController::class, 'index']);

    // ! Sticky Headers
    Route::controller(ApiStickyHeaderController::class)->group(function () {});
    Route::get('sticky-headers', [ApiStickyHeaderController::class, 'index']);

    // ! Blogs
    Route::controller(ApiBlogController::class)->group(function () {});
    Route::get('blogs', [ApiBlogController::class, 'index']);

    // ! Teams
    Route::controller(ApiTeamController::class)->group(function () {});
    Route::get('teams', [ApiTeamController::class, 'index']);

    // ! Solution Cards
    Route::controller(ApiSolutionCardController::class)->group(function () {});
    Route::get('solution-cards', [ApiSolutionCardController::class, 'index']);

    // ! Events
    Route::controller(ApiEventController::class)->group(function () {});
    Route::get('events', [ApiEventController::class, 'index']);

    // ! Projects
    Route::controller(ApiProjectController::class)->group(function () {});
    Route::get('projects', [ApiProjectController::class, 'index']);

    // ! Packages
    Route::controller(ApiPackageController::class)->group(function () {});
    Route::get('packages', [ApiPackageController::class, 'index']);

    // ! Quotations
    Route::controller(ApiQuotationController::class)->group(function () {});
    Route::get('quotations', [ApiQuotationController::class, 'index']);

    // ! Faqs
    Route::controller(ApiFaqController::class)->group(function () {});
    Route::get('faqs', [ApiFaqController::class, 'index']);

    // ! Answers
    // ! Customers
});
