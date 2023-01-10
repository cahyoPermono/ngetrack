<?php

use App\Events\NewTrade;
use App\Http\Controllers\TroubleshootController;
use App\Http\Controllers\VehicleTrackingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('trackings', [VehicleTrackingController::class, 'store'])->name('trackings.create');
Route::get('trackings', [VehicleTrackingController::class, 'index'])->name('trackings.list');
Route::get('daily', [VehicleTrackingController::class, 'daily'])->name('trackings.daily');
Route::get('weekly', [VehicleTrackingController::class, 'weekly'])->name('trackings.weekly');
Route::get('monthly', [VehicleTrackingController::class, 'monthly'])->name('trackings.monthly');
Route::get('yearly', [VehicleTrackingController::class, 'yearly'])->name('trackings.yearly');
Route::get('troubleshoots', [TroubleshootController::class, 'list'])->name('troubleshoots.list');
Route::post('troubleshoots', [TroubleshootController::class, 'storeDevice'])->name('troubleshoot');



