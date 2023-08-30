<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Tests\Stubs;

use Illuminate\Support\Collection;
use Inisiatif\EventHistory\Concerns\EventHistoryAwareInterface;

final class CollectionModelEventStub implements EventHistoryAwareInterface
{
    public function __construct(
        public readonly Collection $stubs
    ) {
    }

    public function getModelAwareHistories(): Collection
    {
        return $this->stubs;
    }

    public function getHistoryDescription(): string
    {
        return 'Example description';
    }
}
