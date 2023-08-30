<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Tests;

use Orchestra\Testbench;
use Inisiatif\EventHistory\EventHistories;
use Illuminate\Contracts\Config\Repository;
use Inisiatif\EventHistory\EventHistoryServiceProvider;

abstract class TestCase extends Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            EventHistoryServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        \tap($app->make('config'), static function (Repository $config): void {
            $config->set('database.default', 'testing');

            $config->set('database.connections.testing', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]);
        });
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadLaravelMigrations();

        $workingPath = \defined('TESTBENCH_WORKING_PATH') ? TESTBENCH_WORKING_PATH : getcwd();

        $this->loadMigrationsFrom($workingPath . DIRECTORY_SEPARATOR . 'database/migrations');
    }

    protected function defineRoutes($router): void
    {
        $router->group([], static function (): void {
            EventHistories::routes();
        });
    }
}
