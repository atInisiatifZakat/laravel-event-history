<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Tests;

use Inisiatif\EventHistory\Tests\Stubs\ModelStub;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class CreateEventHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_new_event_when_create_model(): void
    {
        /** @var ModelStub $stubModel */
        $stubModel = ModelStub::query()->create([
            'name' => 'Foo',
            'email' => 'foo@bar.com',
            'password' => 'password',
        ]);

        $stubModel->newSyncHistory('event', 'New model', 'Comment');

        $history = $stubModel->histories()->first();
        $this->assertNotNull($history);

        $this->assertSame(ModelStub::class, $history->getAttribute('model_type'));
        $this->assertEquals($stubModel->getKey(), $history->getAttribute('model_id'));

        $this->assertSame('New model', $history->getAttribute('description'));
        $this->assertSame('Comment', $history->getAttribute('comment'));

        $this->assertSame('127.0.0.1', $history->getAttribute('ip_address'));

        $this->assertNull($history->getAttribute('user_id'));
    }

    public function test_create_new_event_when_update_model(): void
    {
        /** @var ModelStub $stubModel */
        $stubModel = ModelStub::query()->create([
            'name' => 'Foo',
            'email' => 'foo@bar.com',
            'password' => 'password',
        ]);

        $stubModel->update([
            'name' => 'Foo Update',
        ]);

        $stubModel->newSyncHistory('event', 'Update model', 'Comment');

        $history = $stubModel->histories()->first();
        $this->assertNotNull($history);

        $this->assertSame(ModelStub::class, $history->getAttribute('model_type'));
        $this->assertEquals($stubModel->getKey(), $history->getAttribute('model_id'));

        $this->assertSame('Update model', $history->getAttribute('description'));
        $this->assertSame('Comment', $history->getAttribute('comment'));

        $this->assertSame('127.0.0.1', $history->getAttribute('ip_address'));
        $this->assertNull($history->getAttribute('user_id'));
    }
}
