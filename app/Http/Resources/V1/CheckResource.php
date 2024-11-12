<?php

namespace App\Http\Resources\V1;

use App\Models\Check;
use Illuminate\Http\Request;
use Tests\Resources\UserResource;
use TiMacDonald\JsonApi\JsonApiResource;

/**
 * @property Check $resource
 */
class CheckResource extends JsonApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'path' => $this->resource->path,
            'method' => $this->resource->method,
            'body' => $this->resource->body,
            'headers' => $this->resource->headers,
            'parameters' => $this->resource->parameters,
            'service' => new ServiceResource(
                resource: $this->resource->service
            ),
            'credential' => new UserResource(
                resource: $this->resource->user
            )
        ];
    }
}
