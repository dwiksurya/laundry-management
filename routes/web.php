<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaundryServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/branch', BranchController::class);
    Route::resource('/staff', StaffController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/laundry-service', LaundryServiceController::class);

    Route::get('/oroder/{order}/print', [OrderController::class, 'print'])->name('order.print');
    Route::post('/oroder/{order}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::resource('/order', OrderController::class);
});


require __DIR__.'/auth.php';
