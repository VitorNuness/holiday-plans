<?php

use App\Models\HolidayPlan;
use App\Models\User;
use Laravel\Passport\Passport;
use function Pest\Laravel\getJson;

it('should be get a holiday plan', function () {
    $holidayPlan = HolidayPlan::factory()->create();
    $user = User::factory()->create();

    Passport::actingAs($user);

    getJson(route('plans.show', $holidayPlan->id))
        ->assertSuccessful()
        ->assertJsonIsObject();
});

it('should dont get a holiday plan', function () {
    $holidayPlan = HolidayPlan::factory()->create();
    $user = User::factory()->create();

    Passport::actingAs($user);

    getJson(route('plans.show', $holidayPlan->id + 1))
        ->assertNotFound();
});
