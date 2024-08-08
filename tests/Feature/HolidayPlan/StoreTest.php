<?php

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

it('should be able to store a new holiday plan', function () {
    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => 'Something',
        'participants' => null,
    ])->assertSuccessful();

    assertDatabaseHas('holiday_plans', [
        'title' => 'Something',
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => 'Something',
        'participants' => null,
    ]);
});

it('should be require a title to holiday plan', function () {
    postJson(route('plans.store'), [
        'title' => '',
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => 'Something',
        'participants' => null,
    ])->assertInvalid([
        'title' => 'required',
    ]);
});

it('should be max of 50 character for the title of holiday plan', function () {
    postJson(route('plans.store'), [
        'title' => str_repeat('a', 51),
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => 'Something',
        'participants' => null,
    ])->assertInvalid([
        'title' => 'greater than 50',
    ]);
});

it('should be max of 100 character for the description of holiday plan', function () {
    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => str_repeat('a', 101),
        'date' => '2024-08-08',
        'location' => 'Something',
        'participants' => null,
    ])->assertInvalid([
        'description' => 'greater than 100',
    ]);
});

it('should be require a date for holiday plan', function () {
    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => 'Something',
        'date' => '',
        'location' => 'Something',
        'participants' => null,
    ])->assertInvalid([
        'date' => 'required',
    ]);
});

it('should be a valid date for holiday plan', function () {
    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => 'Something',
        'date' => 'aaa',
        'location' => 'Something',
        'participants' => null,
    ])->assertInvalid([
        'date' => 'valid date',
    ]);
});

it('should be require a location for holiday plan', function () {
    postJson(route('plans.store'), [
        'title' => 'Something',
        'description' => 'Something',
        'date' => '2024-08-08',
        'location' => '',
        'participants' => null,
    ])->assertInvalid([
        'location' => 'required',
    ]);
});
