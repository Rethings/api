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

final class DeactivateApp
{
    public function execute(App $app): App
    {
        $app->forceFill([
            'deactivated_at' => now(),
        ])->save();

        return $app;
    }
}
