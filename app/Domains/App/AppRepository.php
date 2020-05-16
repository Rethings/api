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

use Rethings\Domains\Auth\Actor;

final class AppRepository
{
    public function findActiveById(string $appId): App
    {
        return App::whereNull('deactivated_at')->whereId($appId)->firstOrFail();
    }

    public function getAllLiveByActor(Actor $actor)
    {
        return App::byOwner($actor)
            ->orderByDesc('created_at')
            ->get();
    }

    public function findAppApiKey(string $appId, string $appApiKeyId): AppApiKey
    {
        return AppApiKey::whereAppId($appId)
            ->whereId($appApiKeyId)
            ->firstOrFail();
    }
}
