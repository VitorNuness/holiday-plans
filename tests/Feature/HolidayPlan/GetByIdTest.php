<?php

use App\Models\HolidayPlan;
use function Pest\Laravel\getJson;

it('should be get a holiday plan', function () {
    $holidayPlan = HolidayPlan::factory()->create();

    getJson(route('plans.show', $holidayPlan->id))
        ->assertSuccessful()
        ->assertJsonIsObject();
});

it('should dont get a holiday plan', function () {
    $holidayPlan = HolidayPlan::factory()->create();

    getJson(route('plans.show', $holidayPlan->id + 1))
        ->assertNotFound();
});
