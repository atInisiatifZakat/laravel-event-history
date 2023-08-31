<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Inisiatif\EventHistory\Concerns\HasEventHistories;

final class NewEventHistoryJob implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        private readonly HasEventHistories $model,
        private readonly string $event,
        private readonly string $description,
        private readonly ?string $comment = null,
        private readonly ?string $ipAddress = null,
        private readonly null|string|int $userId = null,
        private readonly ?string $userAgent = null
    ) {
    }

    public function handle(): void
    {
        $this->model->newAsyncHistory(
            $this->event,
            $this->description,
            $this->comment,
            $this->ipAddress,
            $this->userId,
            $this->userAgent
        );
    }
}
