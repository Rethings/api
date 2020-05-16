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
use Rethings\Domains\App\AppApiKey;
use Rethings\Domains\App\Enums\AppApiKeyType;
use Rethings\Domains\App\Events\AppApiKeyWasCreated;

final class CreateApiKey
{
    public function execute(App $app, string $name, AppApiKeyType $type): AppApiKey
    {
        $appApiKey = AppApiKey::forceMake(
            compact('name', 'type') +
            [
                'id' => $type->is(AppApiKeyType::RESET) ?
                    AppApiKey::generateKey('rk_') :
                    AppApiKey::generateKey('sk_'),
            ]
        );

        $app->apiKeys()->save($appApiKey);

        event(new AppApiKeyWasCreated($appApiKey->getKey()));

        return $appApiKey;
    }
}
