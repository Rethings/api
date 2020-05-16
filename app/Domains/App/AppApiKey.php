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
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rethings\Domains\App\Enums\AppApiKeyStatus;
use Rethings\Domains\App\Enums\AppApiKeyType;
use Rethings\Support\Database\Concerns\CamelCasedAttributes;
use Rethings\Support\Database\Concerns\ForceMake;
use Rethings\Support\Database\Concerns\StringKey;
use Rethings\Support\Database\Concerns\ThrowsNotFound;

class AppApiKey extends Model
{
    use StringKey,
        CamelCasedAttributes,
        ForceMake,
        SoftDeletes,
        ThrowsNotFound;

    public static function getKeyLength(): int
    {
        return 48;
    }

    public static function getKeyPrefix(): string
    {
    }

    public function app(): Relation
    {
        return $this->belongsTo(App::class);
    }

    public function setTypeAttribute(AppApiKeyType $apiKeyType): void
    {
        $this->attributes['type'] = $apiKeyType->get();
    }

    public function getTypeAttribute(): AppApiKeyType
    {
        return new AppApiKeyType($this->attributes['type']);
    }

    public function getStatusAttribute(): AppApiKeyStatus
    {
        return $this->deletedAt === null ?
            new AppApiKeyStatus(AppApiKeyStatus::ACTIVE) :
            new AppApiKeyStatus(AppApiKeyStatus::INVALIDATED);
    }
}
