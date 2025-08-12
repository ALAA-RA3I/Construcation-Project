<?php

use App\Http\Controllers\View\ClientOrderController;
use App\Http\Controllers\View\ClientWebController;
use App\Http\Controllers\View\ProjectSalesDetailsBladeController;
use App\Http\Controllers\View\PropertyBookBladeController;
use App\Http\Controllers\View\WebSitePagesController;
use Illuminate\Support\Facades\Route;


Route::get('login', [ClientWebController::class, 'showLoginForm'])->name('client.login');
Route::post('login', [ClientWebController::class, 'login'])->name('client.login');

// Registration Routes
Route::get('register', [ClientWebController::class, 'showRegistrationForm'])->name('client.register');
Route::post('register', [ClientWebController::class, 'register'])->name('client.register');

// Logout Route
Route::post('logout', [ClientWebController::class, 'logout'])->name('client.logout');



Route::middleware(['auth:client'])->group(function () {

}
);

Route::get('test',function (){
    return view('components.alert');
});
Route::get('/',[WebSitePagesController::class,'homePage'])->name('home');

Route::get('projects',[WebSitePagesController::class,'projectsPage'])->name('projects');
Route::get('services',[WebSitePagesController::class,'servicesPage'])->name('services');
Route::get('about-us',[WebSitePagesController::class,'aboutPage'])->name('about');
Route::get('contact-us',[WebSitePagesController::class,'contactPage'])->name('contact');



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

Route::prefix('order')->group(function (){
    Route::post('orderRegister', [ClientOrderController::class,'create'])->name('registerOrder');
});
Route::get('my-orders', [ClientOrderController::class,'myOrders'])->name('myOrders');



