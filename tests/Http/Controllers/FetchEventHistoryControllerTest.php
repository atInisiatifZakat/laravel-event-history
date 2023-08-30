<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Tests\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Inisiatif\EventHistory\EventHistories;
use Inisiatif\EventHistory\Tests\TestCase;
use Orchestra\Testbench\Factories\UserFactory;
use Inisiatif\EventHistory\Tests\Stubs\ModelStub;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inisiatif\EventHistory\Database\Factories\EventHistoryFactory;

final class FetchEventHistoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_fetch_using_model(): void
    {
        $this->withoutExceptionHandling();

        EventHistories::useUserModelClassName(User::class);

        $stubModel = ModelStub::query()->create([
            'name' => 'Foo',
            'email' => 'foo@bar.com',
            'password' => 'password',
        ]);

        EventHistoryFactory::new([
            'user_id' => UserFactory::new()->createOne()->getKey(),
            'model_type' => ModelStub::class,
            'model_id' => $stubModel->getKey(),
        ])->createMany(3);

        $response = $this->getJson('/event-history/model/'.$stubModel->getKey())->assertSuccessful();

        $this->assertCount(3, $response->json('data'));
    }

    public function test_can_fetch_with_valid_resource(): void
    {
        $this->withoutExceptionHandling();

        EventHistories::useUserModelClassName(User::class);

        $stubModel = ModelStub::query()->create([
            'name' => 'Foo',
            'email' => 'foo@bar.com',
            'password' => 'password',
        ]);

        $history = EventHistoryFactory::new([
            'user_id' => UserFactory::new()->createOne()->getKey(),
            'model_type' => ModelStub::class,
            'model_id' => $stubModel->getKey(),
        ])->createOne();

        $response = $this->getJson('/event-history/model/'.$stubModel->getKey())->assertSuccessful();

        $this->assertSame($history->getKey(), $response->json('data.0.id'));
        $this->assertSame($history->getAttribute('event'), $response->json('data.0.event'));
        $this->assertSame($history->getAttribute('description'), $response->json('data.0.description'));
        $this->assertSame($history->getAttribute('comment'), $response->json('data.0.comment'));
        $this->assertSame($history->getAttribute('user')?->getAttribute('id'), $response->json('data.0.user.id'));
        $this->assertSame($history->getAttribute('user')?->getAttribute('name'), $response->json('data.0.user.name'));
        $this->assertSame($history->getAttribute('ip_address'), $response->json('data.0.ip_address'));
        $this->assertSame($history->getAttribute('new_values'), $response->json('data.0.new_values'));
        $this->assertSame($history->getAttribute('created_at')?->toJSON(), $response->json('data.0.created_at'));
    }

    public function test_can_fetch_single_event_history(): void
    {
        $this->withoutExceptionHandling();

        EventHistories::useUserModelClassName(User::class);

        $stubModel = ModelStub::query()->create([
            'name' => 'Foo',
            'email' => 'foo@bar.com',
            'password' => 'password',
        ]);

        $history = EventHistoryFactory::new([
            'user_id' => UserFactory::new()->createOne()->getKey(),
            'model_type' => ModelStub::class,
            'model_id' => $stubModel->getKey(),
        ])->createOne();

        $response = $this->getJson('/event-history/'.$history->getKey())->assertSuccessful();

        $this->assertSame($history->getKey(), $response->json('data.id'));
        $this->assertSame($history->getAttribute('event'), $response->json('data.event'));
        $this->assertSame($history->getAttribute('description'), $response->json('data.description'));
        $this->assertSame($history->getAttribute('comment'), $response->json('data.comment'));
        $this->assertSame($history->getAttribute('user')?->getAttribute('id'), $response->json('data.user.id'));
        $this->assertSame($history->getAttribute('user')?->getAttribute('name'), $response->json('data.user.name'));
        $this->assertSame($history->getAttribute('ip_address'), $response->json('data.ip_address'));
        $this->assertSame($history->getAttribute('new_values'), $response->json('data.new_values'));
        $this->assertSame($history->getAttribute('created_at')?->toJSON(), $response->json('data.created_at'));
    }
}
