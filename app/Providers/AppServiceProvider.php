<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Rethings\Support\Mixins\ArrMixin;
use Rethings\Support\Mixins\BlueprintMixin;
use Rethings\Support\Mixins\RequestMixin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::$wrap = null;

        Blueprint::mixin(new BlueprintMixin());
        Request::mixin(new RequestMixin());
        Arr::mixin(new ArrMixin());
    }
}
