<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Models;

use Illuminate\Database\Eloquent\Model;
use Inisiatif\EventHistory\EventHistories;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class EventHistory extends Model
{
    use HasUlids;

    protected $guarded = [];

    protected $casts = [
        'new_values' => 'json',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(EventHistories::getUserModelClassName(), 'user_id');
    }

    public function getTable(): string
    {
        return EventHistories::getModelTableName();
    }
}
