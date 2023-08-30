<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory;

use Webmozart\Assert\Assert;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Inisiatif\EventHistory\Models\EventHistory;
use Inisiatif\EventHistory\Http\Controllers\FetchEventHistoryController;

final class EventHistories
{
    private static string $modelTableName = 'event_histories';

    private static string $modelClassName = EventHistory::class;

    private static ?string $userModelClassName = null;

    public static function useModelClassName(string $className): void
    {
        self::$modelClassName = $className;
    }

    public static function useModelTableName(string $tableName): void
    {
        self::$modelTableName = $tableName;
    }

    public static function useUserModelClassName(string $userClassName): void
    {
        self::$userModelClassName = $userClassName;
    }

    public static function getModelClassName(): string
    {
        return self::$modelClassName;
    }

    public static function getModelTableName(): string
    {
        return self::$modelTableName;
    }

    public static function getUserModelClassName(): string
    {
        $className = self::$userModelClassName;

        Assert::notNull($className);

        return $className;
    }

    public static function getEventHistoryModel(): Model
    {
        return app(self::$modelClassName);
    }

    public static function getEventHistoryQuery(): Builder
    {
        return self::getEventHistoryModel()->newQuery();
    }

    public static function routes(): void
    {
        Route::get('/event-history/model/{model}', [FetchEventHistoryController::class, 'index']);
        Route::get('/event-history/{id}', [FetchEventHistoryController::class, 'show']);
    }
}
