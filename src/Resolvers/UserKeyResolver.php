<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Resolvers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

final class UserKeyResolver implements Resolver
{
    public static function resolve(): null|string|int
    {
        /** @var Model|null $user */
        $user = Auth::user();

        return $user?->getKey();
    }
}
