<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\App;

use Rethings\Providers\DomainServiceProvider;

final class AppDomainServiceProvider extends DomainServiceProvider
{
    public function listeners(): array
    {
        return [
        ];
    }

    public function aliases(): array
    {
        return [
        ];
    }

    public function policies(): array
    {
        return [
            App::class => AppPolicy::class,
        ];
    }

    public function morphMap(): array
    {
        return [
        ];
    }
}
