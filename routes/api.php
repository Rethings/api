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
    Route::match(['POST', 'PUT', 'PATCH'], '/apps/{appId}/restore', [AppController::class, 'restore'])->name('apps.restore');
    Route::apiResource('apps.api-keys', AppApiKeyController::class)
        ->except('update');
});
