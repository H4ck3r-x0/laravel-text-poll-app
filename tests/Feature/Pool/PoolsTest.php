<?php

use App\Models\Pool;
use App\Models\User;
use Livewire\Volt\Volt;


test('user can select an option', function () {
    $user = User::factory()->create();

    $pool = Pool::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('pool.pools')
        ->set('selectedOption', []);

    $component->call('selectOption', $pool->id, $pool->options->first()->id);

    $component->assertSet('selectedOption.' . $pool->id, $pool->options->first()->id);
});

test('user can vote for a pool option', function () {
    $user = User::factory()->create();

    $pool = Pool::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('pool.pools')
        ->set('selectedOption', []);

    $component->call('selectOption', $pool->id, $pool->options->first()->id);

    $component->call('vote', $pool->id);

    $this->assertDatabaseHas('votes', [
        'user_id' => $user->id,
        'pool_id' => $pool->id,
        'option_id' => $pool->options->first()->id,
    ]);
});

test('user can like a pool', function () {
    $user = User::factory()->create();

    $pool = Pool::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('pool.pools');

    $component->call('like', $pool->id);

    $this->assertDatabaseHas('pool_likes', [
        'user_id' => $user->id,
        'pool_id' => $pool->id,
    ]);
});

test('user can unlike a pool', function () {
    $user = User::factory()->create();

    $pool = Pool::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('pool.pools');

    $component->call('like', $pool->id);

    $component->call('like', $pool->id);

    $this->assertDatabaseMissing('pool_likes', [
        'user_id' => $user->id,
        'pool_id' => $pool->id,
    ]);
});
