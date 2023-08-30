<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class EventHistoryResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->getKey(),
            'event' => $this->resource->getAttribute('event'),
            'description' => $this->resource->getAttribute('description'),
            'comment' => $this->resource->getAttribute('comment'),
            'user' => new UserResource($this->whenLoaded('user')),
            'ip_address' => $this->resource->getAttribute('ip_address'),
            'new_values' => $this->resource->getAttribute('new_values'),
            'created_at' => $this->resource->getAttribute('created_at'),
        ];
    }
}
