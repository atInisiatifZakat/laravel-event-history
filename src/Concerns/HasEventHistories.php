<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasEventHistories
{
    public function histories(): MorphMany;

    public function newSyncHistory(string $event, string $description, string $comment = null): void;

    public function newAsyncHistory(string $event, string $description, string $comment = null, string $ipAddress = null, string|int $userId = null, string|null $userAgent = null): void;
}
