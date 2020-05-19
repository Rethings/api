<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Device;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use LogicException;
use Rethings\Domains\App\App;
use Rethings\Domains\Mqtt\MqttCredential;
use Rethings\Support\Database\Concerns\CamelCasedAttributes;
use Rethings\Support\Database\Concerns\HasExternalId;
use Rethings\Support\Database\Concerns\HasOwner;
use Rethings\Support\Database\Concerns\ThrowsNotFound;

class Device extends Model
{
    use HasExternalId,
        CamelCasedAttributes,
        ThrowsNotFound,
        HasOwner,
        SoftDeletes;

    protected $casts = [
        'metadata' => 'array',
        'tags' => 'array',
    ];

    public static function getKeyPrefix(): string
    {
        return 'dev_';
    }

    public static function getPemAttribute(): string
    {
        throw new LogicException('Unsupported authentication method (yet)');
    }

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    public function mqttCredentials(): BelongsToMany
    {
        return $this
            ->belongsToMany(MqttCredential::class, 'device_mqtt_credentials')
            ->orderByDesc('created_at')
            ->withTimestamps();
    }
}
