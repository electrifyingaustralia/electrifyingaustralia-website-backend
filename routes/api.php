<?php

use App\Http\Controllers\Api\ApiBenefitController;
use App\Http\Controllers\Api\ApiBlogCategoryController;
use App\Http\Controllers\Api\ApiBlogController;
use App\Http\Controllers\Api\ApiBrandController;
use App\Http\Controllers\Api\ApiCustomerController;
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
    Route::get('heroes', [ApiHeroController::class, 'index']);

    // ! Brands
    Route::get('brands', [ApiBrandController::class, 'index']);

    // ! Products
    Route::get('products', [ApiProductController::class, 'index']);
    Route::get('products/types', [ApiProductController::class, 'getProductTypes']);
    Route::get('products/{slug}', [ApiProductController::class, 'show']);

    // ! Benefits
    Route::get('benefits', [ApiBenefitController::class, 'index']);

    // ! Sticky Headers
    Route::get('sticky-headers', [ApiStickyHeaderController::class, 'index']);

    // ! Blogs
    Route::get('blogs', [ApiBlogController::class, 'index']);
    Route::get('blogs/{slug}', [ApiBlogController::class, 'show']);
    Route::get('blog-categories', [ApiBlogCategoryController::class, 'index']);
    Route::get('blog-categories/{slug}/blogs', [ApiBlogCategoryController::class, 'getBlogsByCategory']);

    // ! Teams
    Route::get('teams', [ApiTeamController::class, 'index']);

    // ! Solution Cards
    Route::get('solution-cards', [ApiSolutionCardController::class, 'index']);

    // ! Events
    Route::get('events/groups', [ApiEventController::class, 'index']);
    Route::get('events/{slug}', [ApiEventController::class, 'show']);

    // ! Projects
    Route::get('projects', [ApiProjectController::class, 'index']);
    Route::get('projects/{slug}', [ApiProjectController::class, 'show']);

    // ! Packages
    Route::get('packages', [ApiPackageController::class, 'index']);

    // ! Quotations
    Route::get('quotations', [ApiQuotationController::class, 'index']);

    // ! Faqs
    Route::get('faqs', [ApiFaqController::class, 'index']);
    Route::get('faqs/types', [ApiFaqController::class, 'getFaqTypes']);
    Route::get('faqs/questions', [ApiFaqController::class, 'getFaqByType']);

    // !Quotation
    Route::get('quotation/categories', [ApiQuotationController::class, 'index']);
    Route::get('quotation/category/{id}', [ApiQuotationController::class, 'findSubcategories']);
    Route::get('quotation/questions', [ApiQuotationController::class, 'findQuestions']);
    Route::post('quotation/save', [ApiQuotationController::class, 'saveCustomerQuotation']);

    // ! Customers
    Route::post('/customers', [ApiCustomerController::class, 'store']);
});
