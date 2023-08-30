<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserResource extends JsonResource
{
    /**
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource?->getKey(),
            'name' => $this->resource?->getAttribute('name'),
        ];
    }
}
