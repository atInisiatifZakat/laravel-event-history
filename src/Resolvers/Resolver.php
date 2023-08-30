<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Resolvers;

interface Resolver
{
    public static function resolve(): mixed;
}
