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

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rethings\Domains\App\Enums\AppStatus;
use Rethings\Support\Database\Concerns\CamelCasedAttributes;
use Rethings\Support\Database\Concerns\HasOwner;
use Rethings\Support\Database\Concerns\StringKey;
use Rethings\Support\Database\Concerns\ThrowsNotFound;

class App extends Model
{
    use StringKey,
        CamelCasedAttributes,
        HasOwner,
        SoftDeletes,
        ThrowsNotFound;

    public static function getKeyPrefix(): string
    {
        return 'app_';
    }

    public function getStatusAttribute(): AppStatus
    {
        return $this->deactivatedAt === null ?
            new AppStatus(AppStatus::ACTIVE) :
            new AppStatus(AppStatus::INACTIVE);
    }

    public function apiKeys(): HasMany
    {
        return $this->hasMany(AppApiKey::class)->orderByDesc('created_at');
    }
}
