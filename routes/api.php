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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('heroes', [ApiHeroController::class, 'index']);
    Route::get('brands', [ApiBrandController::class, 'index']);
    Route::get('products', [ApiProductController::class, 'index']);
    Route::get('benefits', [ApiBenefitController::class, 'index']);
    Route::get('sticky-headers', [ApiStickyHeaderController::class, 'index']);
    Route::get('blogs', [ApiBlogController::class, 'index']);
    Route::get('teams', [ApiTeamController::class, 'index']);
    Route::get('solution-cards', [ApiSolutionCardController::class, 'index']);
    Route::get('events', [ApiEventController::class, 'index']);
    Route::get('projects', [ApiProjectController::class, 'index']);
    Route::get('packages', [ApiPackageController::class, 'index']);
    Route::get('quotations', [ApiQuotationController::class, 'index']);
    Route::get('faqs', [ApiFaqController::class, 'index']);
});
