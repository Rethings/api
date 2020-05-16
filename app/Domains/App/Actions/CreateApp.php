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
use Rethings\Domains\App\Enums\AppApiKeyType;
use Rethings\Domains\App\Events\AppWasCreated;
use Rethings\Domains\Auth\Actor;

final class CreateApp
{
    private CreateApiKey $createApiKey;

    public function __construct(CreateApiKey $createApiKey)
    {
        $this->createApiKey = $createApiKey;
    }

    public function execute(
        Actor $owner,
        string $id,
        string $name,
        string $publicKey
    ): App {
        $app = App::forceCreate(compact('id', 'name', 'publicKey', 'owner'));

        event(new AppWasCreated($app->getKey()));

        $this->createApiKey->execute($app, 'Secret Key', new AppApiKeyType(AppApiKeyType::SECRET));
        $this->createApiKey->execute($app, 'Reset Key', new AppApiKeyType(AppApiKeyType::RESET));

        return $app;
    }
}
