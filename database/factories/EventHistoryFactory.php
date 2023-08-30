<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Database\Factories;

use Inisiatif\EventHistory\Models\EventHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

final class EventHistoryFactory extends Factory
{
    protected $model = EventHistory::class;

    public function definition(): array
    {
        return [
            'event' => $this->faker->randomElement(['update', 'save']),
            'description' => $this->faker->sentence(),
            'comment' => $this->faker->sentence(),
            'ip_address' => $this->faker->ipv4(),
        ];
    }
}
