<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support\Mixins;

use Rethings\Domains\App\App;

final class RequestMixin
{
    public function hasApp(): callable
    {
        return function (): bool {
            return $this->getAppId() !== null;
        };
    }

    public function getAppId(): callable
    {
        return function (): ?string {
            return $this->header('X-APP-ID');
        };
    }

    public function app()
    {
        return function (): App {
            static $instance;
            if (!isset($instance)) {
                $instance = $this->getAppId() ?
                    App::find($this->getAppId()) : null;
            }

            return $instance;
        };
    }
}
