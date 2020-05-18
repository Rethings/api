<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

use Rethings\Http\Controllers\AppApiKeyController;
use Rethings\Http\Controllers\AppController;
use Rethings\Http\Controllers\DeviceController;

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

Route::middleware(['auth:api', 'actor:user'])->group(function (): void {
    Route::apiResource('apps', AppController::class)->except('update');
    Route::patch('/apps/{app}', [AppController::class, 'patch'])->name('apps.patch');
    Route::put('/apps/{app}', [AppController::class, 'update'])->name('apps.update');

    Route::post('/apps/{app}/restore', [AppController::class, 'restore'])->name('apps.restore');
    Route::apiResource('apps.api-keys', AppApiKeyController::class)
        ->except('update');
});

Route::middleware(['auth:api', 'actor:consumer'])->group(function (): void {
    Route::apiResource('devices', DeviceController::class)->except('update', 'store');
    Route::patch('/devices/{device}', [DeviceController::class, 'patch'])->name('devices.patch');
    Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update');
    Route::post('/devices/{device?}', [DeviceController::class, 'store'])->name('devices.store');
});
