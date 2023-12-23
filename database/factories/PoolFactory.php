<?php

namespace Database\Factories;

use App\Models\Pool;
use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pool>
 */
class PoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,
            'user_id' => \App\Models\User::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Pool $pool) {
            Option::factory()->create(['pool_id' => $pool->id]);
        });
    }
}
