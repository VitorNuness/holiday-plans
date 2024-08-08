<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

it('should be able to store a new holiday plan', function () {
    $user = User::factory()->create();

    actingAs($user, 'api');

    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => 'Something',
        'participants' => [],
    ])->assertSuccessful();

    assertDatabaseHas('holiday_plans', [
        'title' => 'Something',
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => 'Something',
        'participants' => "[]",
    ]);
});

it('should be require a title to holiday plan', function () {
    $user = User::factory()->create();

    actingAs($user, 'api');

    postJson(route('plans.store'), [
        'title' => '',
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => 'Something',
        'participants' => [],
    ])->assertInvalid([
        'title' => 'required',
    ]);
});

it('should be max of 50 character for the title of holiday plan', function () {
    $user = User::factory()->create();

    actingAs($user, 'api');

    postJson(route('plans.store'), [
        'title' => str_repeat('a', 51),
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => 'Something',
        'participants' => [],
    ])->assertInvalid([
        'title' => 'greater than 50',
    ]);
});

it('should be max of 100 character for the description of holiday plan', function () {
    $user = User::factory()->create();

    actingAs($user, 'api');

    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => str_repeat('a', 101),
        'date' => '2024-08-08',
        'location' => 'Something',
        'participants' => [],
    ])->assertInvalid([
        'description' => 'greater than 100',
    ]);
});

it('should be require a date for holiday plan', function () {
    $user = User::factory()->create();

    actingAs($user, 'api');

    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => 'Something',
        'date' => '',
        'location' => 'Something',
        'participants' => [],
    ])->assertInvalid([
        'date' => 'required',
    ]);
});

it('should be a valid date for holiday plan', function () {
    $user = User::factory()->create();

    actingAs($user, 'api');

    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => 'Something',
        'date' => 'aaa',
        'location' => 'Something',
        'participants' => [],
    ])->assertInvalid([
        'date' => 'valid date',
    ]);
});

it('should be require a location for holiday plan', function () {
    $user = User::factory()->create();

    actingAs($user, 'api');

    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => '',
        'participants' => [],
    ])->assertInvalid([
        'location' => 'required',
    ]);
});

it('should be max of 100 character for the location of holiday plan', function () {
    $user = User::factory()->create();

    actingAs($user, 'api');

    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => str_repeat('a', 101),
        'participants' => [],
    ])->assertInvalid([
        'location' => 'greater than 100',
    ]);
});
