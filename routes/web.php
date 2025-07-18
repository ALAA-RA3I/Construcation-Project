<?php

use App\Http\Controllers\Api\ProjectSalesDetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectSalesDetailsBladeController;
use App\Http\Controllers\PropertyBookBladeController;
use App\Http\Controllers\PropertyBookBillBladeController;
use App\Http\Controllers\PropertyUnitBladeController;

Route::get('/', function () {
    return view('pages.home-page');
});

Route::get('/login-static', function () {
    return view('login-static');
});

// Fallback login route to prevent route('login') errors
Route::get('/login', function () {
    return view('login-static'); // or return a simple message
})->name('login');


Route::prefix('project-sales-details')->group(function () {
    Route::get('', [ProjectSalesDetailsBladeController::class, 'index']);
    Route::get('/all', [ProjectSalesDetailsBladeController::class, 'getAll'])->name('project_sales_details.all');
    Route::get('/{id}', [ProjectSalesDetailsBladeController::class, 'show'])->name('project_sales_details.show');
});

Route::prefix('property-book')->group(function () {
    Route::get('/{projectId}', [PropertyBookBladeController::class, 'index']);
    Route::get('/all/{projectId}', [PropertyBookBladeController::class, 'getAll']);
    Route::get('/show/{id}', [PropertyBookBladeController::class, 'show']);
});

Route::prefix('property-book-bill')->group(function () {

    Route::get('/all/{propertyBookId}', [PropertyBookBillBladeController::class, 'getAll']);
    Route::get('/{propertyBookId}', [PropertyBookBillBladeController::class, 'index']);
    Route::get('/getOne/{id}', [PropertyBookBillBladeController::class, 'show']);

});

Route::prefix('property-unit')->group(function () {

    Route::get('/all/{propertyBookId}', [PropertyUnitBladeController::class, 'getAll']);
    Route::get('/{propertyBookId}', [PropertyUnitBladeController::class, 'index']);
    Route::get('/getOne/{propertyBookId}', [PropertyUnitBladeController::class, 'show']);


});
