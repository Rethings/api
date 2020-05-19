<?php

namespace Rethings\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Rethings\Domains\Mqtt\Enum\AuthenticationMethod;

class MqttCredentialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $resp = [
            'id' => $this->id,
            'authenticationMethod' => $this->authenticationMethod,
            'username' => $this->username ?? new MissingValue(),
            'publishableTopics' => $this->publishableTopics,
            'subscribableTopics' => $this->subscribableTopics,
            'createdAt' => $this->createdAt,
        ];
        return $resp;
    }
}
