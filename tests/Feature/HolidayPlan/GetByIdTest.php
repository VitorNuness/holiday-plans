<?php

use App\Models\HolidayPlan;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('should be get a holiday plan', function () {
    $user = User::factory()->create();
    $holidayPlan = HolidayPlan::factory()->create(['user_id' => $user]);

    actingAs($user, 'api');
    getJson(route('plans.show', $holidayPlan->id))
        ->assertSuccessful()
        ->assertJsonIsObject();
});

it('should dont get a holiday plan', function () {
    $holidayPlan = HolidayPlan::factory()->create();
    $user = User::factory()->create();

    actingAs($user, 'api');

    getJson(route('plans.show', $holidayPlan->id))
        ->assertForbidden();
});
