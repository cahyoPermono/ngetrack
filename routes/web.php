<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VesselController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    
    Route::get('vessels', [VesselController::class, 'index'])->name('vessels');
    Route::post('vessels', [VesselController::class, 'store'])->name('vessels.create');
    Route::put('vessels/{vessel}', [VesselController::class, 'update'])->name('vessels.update');
    Route::delete('vessels/{vessel}', [VesselController::class, 'destroy'])->name('vessels.destroy');

    //Routing product
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::post('products', [ProductController::class, 'store'])->name('products.create');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

     //Routing customer
     Route::get('customers', [CustomerController::class, 'index'])->name('customers');
     Route::post('customers', [CustomerController::class, 'store'])->name('customers.create');
     Route::put('customers/{customers}', [CustomerController::class, 'update'])->name('customers.update');
     Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    // Route::resource('vessels', VesselController::class);
});
