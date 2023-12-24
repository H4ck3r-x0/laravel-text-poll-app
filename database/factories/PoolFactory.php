<?php

namespace Database\Factories;

use App\Models\Pool;
use App\Models\Vote;
use App\Models\Option;
use App\Models\PoolLike;
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
            PoolLike::factory(rand(1, 10))->create(['pool_id' => $pool->id]);


            $options = Option::factory(3)->create(['pool_id' => $pool->id]);
            foreach ($options as $option) {
                Vote::factory(rand(1, 10))->create(['option_id' => $option->id, 'pool_id' => $pool->id]);
            }
        });
    }
}
