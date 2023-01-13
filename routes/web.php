<?php

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VesselController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransmitterController;
use App\Http\Controllers\VehiclePictureController;
use App\Http\Controllers\TroubleshootController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleRouteController;
use App\Http\Controllers\VehicleTrackingController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');

    // Routing Vehicles
    Route::get('vehicles', [VehicleController::class, 'index'])->name('vehicles');
    Route::get('vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
    Route::post('vehicles', [VehicleController::class, 'store'])->name('vehicles.create');
    Route::put('vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

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

    //Routing Transmitter
    Route::get('transmitters', [TransmitterController::class, 'index'])->name('transmitters');
    Route::post('transmitters', [TransmitterController::class, 'store'])->name('transmitters.create');
    Route::put('transmitters/{transmitters}', [TransmitterController::class, 'update'])->name('transmitters.update');
    Route::delete('transmitters/{transmitters}', [TransmitterController::class, 'destroy'])->name('transmitters.destroy');

    //Routing Vehicle Routes
    Route::get('routes', [VehicleRouteController::class, 'index'])->name('routes');
    Route::post('routes', [VehicleRouteController::class, 'store'])->name('routes.create');
    Route::put('finish/{route}', [VehicleRouteController::class, 'finish'])->name('routes.finish');
    Route::put('routes/{route}', [VehicleRouteController::class, 'update'])->name('routes.update');
    Route::delete('routes/{route}', [VehicleRouteController::class, 'destroy'])->name('routes.destroy');

    //Routing Troubleshoot Routes
    Route::get('troubleshoots', [TroubleshootController::class, 'index'])->name('troubleshoots');
    Route::post('troubleshoots', [TroubleshootController::class, 'store'])->name('troubleshoots.create');
    Route::put('troubleshoots/{troubleshoots}', [TroubleshootController::class, 'update'])->name('troubleshoots.update');
    Route::delete('troubleshoots/{troubleshoots}', [TroubleshootController::class, 'destroy'])->name('troubleshoots.destroy');

    // Routing for csv generator
    Route::get('/exportTracking', [VehicleTrackingController::class, 'exportCsv'])->name('reportcsv');

    // Route for upload vehicle picture
    Route::post('pictures', [VehiclePictureController::class, 'store'])->name('pictures.create');
});

Route::post('zegister', [UserController::class, 'register'])->name('zegister');
