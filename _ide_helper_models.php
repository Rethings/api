<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Rethings\Domains\App{
/**
 * Rethings\Domains\App\AppApiKey
 *
 * @property string $id
 * @property \Rethings\Domains\App\Enums\AppApiKeyType $type
 * @property string $name
 * @property string $appId
 * @property string|null $invalidatedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property-read \Rethings\Domains\App\App $app
 * @property-read \Rethings\Domains\App\Enums\AppApiKeyStatus $status
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey newQuery()
 * @method static \Illuminate\Database\Query\Builder|\Rethings\Domains\App\AppApiKey onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey whereInvalidatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\AppApiKey whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Rethings\Domains\App\AppApiKey withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Rethings\Domains\App\AppApiKey withoutTrashed()
 */
	class AppApiKey extends \Eloquent {}
}

namespace Rethings\Domains\App{
/**
 * Rethings\Domains\App\App
 *
 * @property string $id
 * @property string $name
 * @property string|null $type
 * @property string $publicKey
 * @property string $ownerId
 * @property string $ownerType
 * @property string|null $deactivatedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property-read \Illuminate\Database\Eloquent\Collection|\Rethings\Domains\App\AppApiKey[] $apiKeys
 * @property-read int|null $apiKeysCount
 * @property \Rethings\Domains\Auth\Actor $owner
 * @property-read \Rethings\Domains\App\Enums\AppStatus $status
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App byOwner(\Rethings\Domains\Auth\Actor $actor)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App newQuery()
 * @method static \Illuminate\Database\Query\Builder|\Rethings\Domains\App\App onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App whereDeactivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App whereOwnerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App wherePublicKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Rethings\Domains\App\App whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Rethings\Domains\App\App withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Rethings\Domains\App\App withoutTrashed()
 */
	class App extends \Eloquent {}
}

