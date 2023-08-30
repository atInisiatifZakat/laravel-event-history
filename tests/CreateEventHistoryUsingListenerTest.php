<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Tests;

use Inisiatif\EventHistory\Tests\Stubs\ModelStub;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inisiatif\EventHistory\RecordEventHistoryListener;
use Inisiatif\EventHistory\Tests\Stubs\ModelEventStub;
use Inisiatif\EventHistory\Tests\Stubs\CollectionModelEventStub;

final class CreateEventHistoryUsingListenerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_history_with_single_model(): void
    {
        /** @var ModelStub $stubModel */
        $stubModel = ModelStub::query()->create([
            'name' => 'Foo',
            'email' => 'foo@bar.com',
            'password' => 'password',
        ]);

        $event = new ModelEventStub($stubModel);

        (new RecordEventHistoryListener())->handle($event);

        $history = $stubModel->histories()->first();

        $this->assertSame(ModelStub::class, $history->getAttribute('model_type'));
        $this->assertEquals($stubModel->getKey(), $history->getAttribute('model_id'));
        $this->assertSame($event->getHistoryDescription(), $history->getAttribute('description'));
        $this->assertSame('127.0.0.1', $history->getAttribute('ip_address'));
        $this->assertSame('Foo', $history->getAttribute('new_values')['name']);
        $this->assertSame('foo@bar.com', $history->getAttribute('new_values')['email']);
        $this->assertSame('password', $history->getAttribute('new_values')['password']);
        $this->assertNull($history->getAttribute('user_id'));
        $this->assertNull($history->getAttribute('comment'));
    }

    public function test_can_create_history_with_collection_model(): void
    {
        /** @var ModelStub $stubModel */
        $stubModel = ModelStub::query()->create([
            'name' => 'Foo',
            'email' => 'foo@bar.com',
            'password' => 'password',
        ]);

        $event = new CollectionModelEventStub(
            collect()->add($stubModel)
        );

        (new RecordEventHistoryListener())->handle($event);

        $history = $stubModel->histories()->first();

        $this->assertSame(ModelStub::class, $history->getAttribute('model_type'));
        $this->assertEquals($stubModel->getKey(), $history->getAttribute('model_id'));
        $this->assertSame($event->getHistoryDescription(), $history->getAttribute('description'));
        $this->assertSame('127.0.0.1', $history->getAttribute('ip_address'));

        $this->assertSame('Foo', $history->getAttribute('new_values')['name']);
        $this->assertSame('foo@bar.com', $history->getAttribute('new_values')['email']);
        $this->assertSame('password', $history->getAttribute('new_values')['password']);

        $this->assertNull($history->getAttribute('user_id'));
        $this->assertNull($history->getAttribute('comment'));
    }
}
