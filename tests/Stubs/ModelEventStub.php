<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Tests\Stubs;

use Inisiatif\EventHistory\Concerns\HasEventHistories;
use Inisiatif\EventHistory\Concerns\EventHistoryAwareInterface;

final class ModelEventStub implements EventHistoryAwareInterface
{
    public function __construct(
        public readonly ModelStub $stub
    ) {
    }

    public function getModelAwareHistories(): HasEventHistories
    {
        return $this->stub;
    }

    public function getHistoryDescription(): string
    {
        return 'Example description';
    }
}
