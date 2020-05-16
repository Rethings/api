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

use Event;
use Gate;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use LogicException;

class DomainServiceProvider extends ServiceProvider
{
    private array $dispatchedListeners = [];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerEvents();

        $this->registerPolicies();

        Relation::morphMap($this->morphMap());

        foreach ($this->aliases() as $alias => $abstract) {
            $this->app->alias($abstract, $alias);
        }
    }

    private function registerPolicies(): void
    {
        foreach ($this->policies() as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }

    private function registerEvents(): void
    {
        $listeners = $this->listeners();
        foreach ($listeners as $event => $eventListeners) {
            $eventListeners = Arr::wrap($eventListeners);
            foreach ($eventListeners as $eventListener) {
                $this->registerEvent($event, $eventListener);
            }
        }
    }

    private function registerEvent($event, $listener): void
    {
        if (!is_callable($listener) && !method_exists($listener, 'handle')) {
            throw new LogicException('Listener should be a callable, invokable or with \'handle\' method.');
        }
        Event::listen($event, $listener);
    }

    /**
     * Returns the event listeners map in
     * Event::class => Listener::class format.
     */
    public function listeners(): array
    {
        return [];
    }

    /**
     * Returns the event listeners map in
     * alias => abstract format.
     */
    public function aliases(): array
    {
        return [];
    }

    /**
     * Returns the event listeners map in
     * Model::class => Policy::class format.
     */
    public function policies(): array
    {
        return [];
    }

    /**
     * Returns the event listeners map in
     * name => Model::class format.
     */
    public function morphMap(): array
    {
        return [];
    }
}
