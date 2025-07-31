<?php

use App\Http\Controllers\Api\ProjectSalesDetailsController;
use App\Http\Controllers\View\WebSitePagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectSalesDetailsBladeController;
use App\Http\Controllers\PropertyBookBladeController;
use App\Http\Controllers\PropertyBookBillBladeController;
use App\Http\Controllers\PropertyUnitBladeController;


Route::get('/',[WebSitePagesController::class,'homePage'])->name('home');
Route::get('projects',[WebSitePagesController::class,'projectsPage'])->name('projects');
Route::get('services',[WebSitePagesController::class,'servicesPage'])->name('services');
Route::get('about-us',[WebSitePagesController::class,'aboutPage'])->name('about');
Route::get('contact-us',[WebSitePagesController::class,'contactPage'])->name('contact');


Route::get('/login-static', function () {
    return view('login-static');
});

// Fallback login route to prevent route('login') errors
Route::get('/login', function () {
    return view('login-static'); // or return a simple message
})->name('login');


Route::prefix('SalesUnits')->group(function () {
    Route::get('', [ProjectSalesDetailsBladeController::class, 'index'])->name('unitsSales');
    Route::get('/all', [ProjectSalesDetailsBladeController::class, 'getAll'])->name('project_sales_details.all');
    Route::get('/{id}', [ProjectSalesDetailsBladeController::class, 'show'])->name('project_sales_details.show');
});

Route::prefix('property-book')->group(function () {
    Route::get('/{projectId}', [PropertyBookBladeController::class, 'index'])->name('unitsBooks');
    Route::get('/all/{projectId}', [PropertyBookBladeController::class, 'getAll']);
    Route::get('/show/{id}', [PropertyBookBladeController::class, 'show'])->name('bookDetails');
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
