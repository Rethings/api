<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Rethings\Support\LinkHelper;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->externalId,
            'name' => $this->name,
            'metadata' => (object) $this->metadata,
            'tags' => $this->tags,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            '_links' => [
                LinkHelper::selfLink(route('devices.show', [$this->externalId], false)),
            ],
        ];
    }
}
