<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Resolvers;

use Illuminate\Support\Facades\Request;

final class UserAgentResolver implements Resolver
{
    public static function resolve(): ?string
    {
        /** @var string|null $userAgent */
        $userAgent = Request::header('User-Agent');

        if (false === \is_string($userAgent)) {
            return null;
        }

        return $userAgent;
    }
}
