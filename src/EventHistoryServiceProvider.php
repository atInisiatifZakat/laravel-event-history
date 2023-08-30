<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class EventHistoryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-event-history')
            ->hasMigration('create_event_history_table');
    }
}
