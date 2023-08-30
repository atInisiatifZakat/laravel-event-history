<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Concerns;

interface EventHistoryAwareInterface
{
    public function getModelAwareHistories(): mixed;

    public function getHistoryDescription(): string;
}
