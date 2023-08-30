<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Http\Controllers;

use Inisiatif\EventHistory\EventHistories;
use Illuminate\Http\Resources\Json\JsonResource;
use Inisiatif\EventHistory\Http\Resources\EventHistoryResource;

final class FetchEventHistoryController
{
    public function index(string|int $model): JsonResource
    {
        return EventHistoryResource::collection(
            EventHistories::getEventHistoryQuery()->where('model_id', $model)->with([
                'user',
            ])->get()
        );
    }

    public function show(string $id): JsonResource
    {
        return EventHistoryResource::make(
            EventHistories::getEventHistoryQuery()->with([
                'user',
            ])->findOrFail($id)
        );
    }
}
