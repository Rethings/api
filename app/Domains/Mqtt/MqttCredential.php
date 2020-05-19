<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Domains\Mqtt;

use Illuminate\Database\Eloquent\Model;
use Rethings\Domains\Mqtt\Enum\AuthenticationMethod;
use Rethings\Support\Database\Concerns\CamelCasedAttributes;
use Rethings\Support\Database\Concerns\StringKey;
use Rethings\Support\Database\Concerns\ThrowsNotFound;

class MqttCredential extends Model
{
    use StringKey,
        CamelCasedAttributes,
        ThrowsNotFound;

    protected $casts = [
        'publishable_topics' => 'array',
        'subscribable_topics' => 'array',
    ];

    public function getAuthenticationMethodAttribute(): AuthenticationMethod
    {
        return new AuthenticationMethod($this->attributes['authentication_method']);
    }

    public function setAuthenticationMethodAttribute(AuthenticationMethod $method): void
    {
        $this->attributes['authentication_method'] = $method->get();
    }
}
