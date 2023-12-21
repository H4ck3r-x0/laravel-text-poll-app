
<?php

use App\Models\User;
use Livewire\Volt\Volt;

test('create pool form is displayed', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get('/');

    $response
        ->assertOk()
        ->assertSeeVolt('pool.create-pool-form');
});

test('can add an option to the create pool form', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('pool.create-pool-form')
        ->set('options', ['', '']);

    $component->call('addOption');

    $component
        ->assertSet('options', ['', '', ''])
        ->assertHasNoErrors();
});

test('can remove an option from the create pool form', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('pool.create-pool-form')
        ->set('options', ['', '']);

    $component->call('removeOption', 1);

    $component
        ->assertSet('options', [''])
        ->assertHasNoErrors();
});

test('can reset the options on the create pool form', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('pool.create-pool-form')
        ->set('options', ['', '']);

    $component->call('resetOptions');

    $component
        ->assertSet('options', [''])
        ->assertHasNoErrors();
});
