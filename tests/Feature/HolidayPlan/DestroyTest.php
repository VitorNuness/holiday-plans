<?php

use App\Models\HolidayPlan;
use function Pest\Laravel\deleteJson;

it('should be delete a holiday plan', function () {
    $holidayPlan = HolidayPlan::factory()->create();

    deleteJson(route('plans.destroy', $holidayPlan->id))
        ->assertNoContent();
});

it('should dont delete a holiday plan', function () {
    $holidayPlan = HolidayPlan::factory()->create();

    deleteJson(route('plans.destroy', $holidayPlan->id + 1))
        ->assertNotFound();
});
