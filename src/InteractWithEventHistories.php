<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Inisiatif\EventHistory\Resolvers\UserKeyResolver;
use Inisiatif\EventHistory\Resolvers\IpAddressResolver;
use Inisiatif\EventHistory\Resolvers\UserAgentResolver;

trait InteractWithEventHistories
{
    public function histories(): MorphMany
    {
        return $this->morphMany(EventHistories::getModelClassName(), 'model');
    }

    public function newSyncHistory(string $event, string $description, string $comment = null): void
    {
        $this->newAsyncHistory(
            $event,
            $description,
            $comment,
            IpAddressResolver::resolve(),
            UserKeyResolver::resolve(),
            UserAgentResolver::resolve()
        );
    }

    public function newAsyncHistory(string $event, string $description, string $comment = null, string $ipAddress = null, string|int $userId = null, string $userAgent = null): void
    {
        $this->histories()->create([
            'event' => $event,
            'description' => $description,
            'comment' => $comment,
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);
    }
}
