<?php

use App\Models\HolidayPlan;
use App\Models\User;


use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('should be download a holiday plan pdf', function () {
    $user = User::factory()->create();
    $holidayPlan = HolidayPlan::factory()->create(['user_id' => $user]);

    actingAs($user, 'api');

    getJson(route('plans.pdf', $holidayPlan->id))
        ->assertSuccessful()
        ->assertDownload('holiday_plan.pdf');
});

it('should dont download a holiday plan pdf', function () {
    $user = User::factory()->create();
    $holidayPlan = HolidayPlan::factory()->create();

    actingAs($user, 'api');

    getJson(route('plans.pdf', $holidayPlan->id))
        ->assertForbidden();
});

it('should get holiday data for the pdf view', function () {
    $holidayPlan = HolidayPlan::factory()->create();

    $view = $this->view('pdf.holiday-plan', ['data' => $holidayPlan]);

    $view
        ->assertSee($holidayPlan->title)
        ->assertSee($holidayPlan->description)
        ->assertSee($holidayPlan->date->format('Y-m-d'))
        ->assertSee($holidayPlan->location);

    foreach ($holidayPlan->participants as $participant) {
        $view->assertSee($participant);
    }
});
