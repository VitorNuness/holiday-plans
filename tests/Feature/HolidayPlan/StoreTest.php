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
    ])->assertValid([
        'title' => 'required',
    ]);
});
