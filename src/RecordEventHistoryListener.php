<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory;

use Illuminate\Support\Collection;
use Inisiatif\EventHistory\Jobs\NewEventHistoryJob;
use Inisiatif\EventHistory\Resolvers\CommentResolver;
use Inisiatif\EventHistory\Resolvers\UserKeyResolver;
use Inisiatif\EventHistory\Concerns\HasEventHistories;
use Inisiatif\EventHistory\Resolvers\IpAddressResolver;
use Inisiatif\EventHistory\Concerns\EventHistoryAwareInterface;

final class RecordEventHistoryListener
{
    public function handle(EventHistoryAwareInterface $event): void
    {
        $model = $event->getModelAwareHistories();

        if ($model instanceof Collection) {
            $model
                ->reject(fn (mixed $item) => ! $item instanceof HasEventHistories)
                ->each(function (HasEventHistories $model) use ($event): void {
                    $this->dispatchJob($model, $event);
                });
        }

        if ($model instanceof HasEventHistories) {
            $this->dispatchJob($model, $event);
        }
    }

    protected function dispatchJob(HasEventHistories $model, EventHistoryAwareInterface $event): void
    {
        $job = new NewEventHistoryJob(
            $model,
            \get_class($event),
            $event->getHistoryDescription(),
            CommentResolver::resolve(),
            IpAddressResolver::resolve(),
            UserKeyResolver::resolve()
        );

        dispatch($job);
    }
}
