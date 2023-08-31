<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Resolvers;

use Illuminate\Support\Facades\Request;

final class UserAgentResolver implements Resolver
{
    public static function resolve(): string
    {
        return Request::header('User-Agent');
    }
}
