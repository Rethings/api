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
use Illuminate\Database\Eloquent\SoftDeletes;
use Rethings\Domains\App\App;
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

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }
}
