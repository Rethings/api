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

final class UpdateApp
{
    public function execute(
        App $app,
        string $name,
        string $publicKey
    ): App {
        $app->forceFill(compact('name', 'publicKey'))->save();

        return $app;
    }
}
