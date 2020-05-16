<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\App\Actions;

use Rethings\Domains\App\App;

final class DestroyApp
{
    public function execute(App $app, bool $force = false): void
    {
        if ($force) {
            $app->forceDelete();
        } else {
            $app->delete();
        }
    }
}
