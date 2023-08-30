<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Resolvers;

use Illuminate\Support\Facades\Request;

final class CommentResolver implements Resolver
{
    public static function resolve(): ?string
    {
        return Request::input('comment');
    }
}
