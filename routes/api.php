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
    Route::apiResource('apps', AppController::class);
    Route::post('/apps/{appId}/restore', [AppController::class, 'restore'])->name('apps.restore');
    Route::apiResource('apps.api-keys', AppApiKeyController::class)
        ->except('update');
});

Route::middleware(['auth:api', 'actor:consumer'])->group(function (): void {
    Route::post('/devices/{deviceId?}', [DeviceController::class, 'store'])->name('devices.store');
    Route::apiResource('devices', DeviceController::class)
        ->only('show');
});
