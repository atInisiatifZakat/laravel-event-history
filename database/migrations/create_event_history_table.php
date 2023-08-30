<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Inisiatif\EventHistory\EventHistories;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(EventHistories::getModelTableName(), function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->string('event');
            $table->string('description');
            $table->string('model_type');
            $table->string('model_id', 36);
            $table->string('user_id', 36)->nullable();
            $table->text('comment')->nullable();
            $table->ipAddress()->nullable();
            $table->timestamps();

            $table->index(['model_type', 'model_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(EventHistories::getModelTableName());
    }
};
