<?php

use App\Models\HolidayPlan;
use App\Models\User;
use Laravel\Passport\Passport;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\deleteJson;

it('should be delete a holiday plan', function () {
    $holidayPlan = HolidayPlan::factory()->create();
    $user = User::factory()->create();

    actingAs($user, 'api');

    deleteJson(route('plans.destroy', $holidayPlan->id))
        ->assertNoContent();
});

it('should dont delete a holiday plan', function () {
    $holidayPlan = HolidayPlan::factory()->create();
    $user = User::factory()->create();

    actingAs($user, 'api');

    deleteJson(route('plans.destroy', $holidayPlan->id + 1))
        ->assertNotFound();
});
