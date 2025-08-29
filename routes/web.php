<?php

use App\Http\Controllers\Clients\stripeController;
use App\Http\Controllers\TestDocuSignController;
use App\Http\Controllers\View\ClientOrderController;
use App\Http\Controllers\View\ClientWebController;
use App\Http\Controllers\View\ProjectSalesDetailsBladeController;
use App\Http\Controllers\View\PropertyBookBladeController;
use App\Http\Controllers\View\WebSitePagesController;
use Illuminate\Support\Facades\Route;
 
Route::get('test-confirm',function (){
    return view('pages.clientOrders.confirm-sign');
});
Route::get('login', [ClientWebController::class, 'showLoginForm'])->name('client.login');
Route::post('login', [ClientWebController::class, 'login'])->name('client.login');

Route::get('/testAccessToken/{orderId}',[TestDocuSignController::class,'testDocuSign'])->name('test');
// Route::post('/testGetSignedFile/{id}',[TestDocuSignController::class,'downloadSignedDoc'])->name('download');


// Registration Routes
Route::get('register', [ClientWebController::class, 'showRegistrationForm'])->name('client.register');
Route::post('register', [ClientWebController::class, 'register'])->name('client.register');

// Logout Route
Route::post('logout', [ClientWebController::class, 'logout'])->name('client.logout');

// Route::get('/testPayment/{bookId}',[stripeController::class,'doFirstPayment'])->name('client.pay');

Route::get('/pay/{orderId}', function ($orderId) {
    return view('stripeTest', ['orderId' => $orderId]);
})->name('pay');


Route::middleware(['auth:client'])->group(
    function () {

}
);

Route::get('/', [WebSitePagesController::class, 'homePage'])->name('home');

Route::get('projects', [WebSitePagesController::class, 'projectsPage'])->name('projects');
Route::get('services', [WebSitePagesController::class, 'servicesPage'])->name('services');
Route::get('about-us', [WebSitePagesController::class, 'aboutPage'])->name('about');
Route::get('contact-us', [WebSitePagesController::class, 'contactPage'])->name('contact');



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

Route::prefix('order')->group(function () {
    Route::post('orderRegister', [ClientOrderController::class, 'create'])->name('registerOrder');
    Route::delete('cancel/{id}', [ClientOrderController::class, 'cancel'])->name('cancelOrder');
});
// Route::post('verify-my-contract/{orderId}', [ClientOrderController::class, 'verifyMyContract'])->name('verify-my-contract');

Route::get('my-orders', [ClientOrderController::class, 'myOrders'])->name('myOrders');
Route::post('/my-orders/{id}/verify-contract', [ClientOrderController::class, 'verifyMyContract'])
    ->name('verifyContract');
Route::get('/contracts/verify/{order}', [ClientOrderController::class, 'show'])->name('contracts.verify.show');
