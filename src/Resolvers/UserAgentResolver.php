<?php

namespace Inisiatif\EventHistory\Resolvers;

use Illuminate\Support\Facades\Request;

final class UserAgentResolver implements Resolver
{
    public static function resolve(): string
    {
        return Request::header('User-Agent');
    }
}
