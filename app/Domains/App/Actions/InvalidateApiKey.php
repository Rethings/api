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

use Rethings\Domains\App\AppApiKey;

final class InvalidateApiKey
{
    public function execute(AppApiKey $apiKey): AppApiKey
    {
        $apiKey->forceFill([
            'invalidated_at' => now(),
        ])->save();

        return $apiKey;
    }
}
