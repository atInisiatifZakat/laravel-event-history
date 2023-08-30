<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use Inisiatif\EventHistory\Concerns\HasEventHistories;
use Inisiatif\EventHistory\InteractWithEventHistories;

final class ModelStub extends Model implements HasEventHistories
{
    use InteractWithEventHistories;

    protected $table = 'users';

    protected $guarded = [];
}
