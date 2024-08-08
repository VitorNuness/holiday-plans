<?php

use App\Models\HolidayPlan;
use App\Models\User;
use Laravel\Passport\Passport;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('should be download a holiday plan pdf', function () {
    $holidayPlan = HolidayPlan::factory()->create();
    $user = User::factory()->create();

    actingAs($user, 'api');

    getJson(route('plans.pdf', $holidayPlan->id))
        ->assertSuccessful()
        ->assertDownload(str_replace(' ', '_', $holidayPlan->title) . '.pdf');
});

it('should dont download a holiday plan pdf', function () {
    $user = User::factory()->create();
    $holidayPlan = HolidayPlan::factory()->create();

    actingAs($user, 'api');

    getJson(route('plans.pdf', $holidayPlan->id + 1))
        ->assertNotFound();
});

it('should get holiday data for the pdf view', function () {
    $holidayPlan = HolidayPlan::factory()->create();

    $this->view('pdf.holiday-plan', ['data' => $holidayPlan])
        ->assertSee($holidayPlan->title)
        ->assertSee($holidayPlan->description)
        ->assertSee($holidayPlan->date->format('Y-m-d'))
        ->assertSee($holidayPlan->location)
        ->assertSee($holidayPlan->participants);
});
