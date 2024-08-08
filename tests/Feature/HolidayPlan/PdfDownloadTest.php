<?php

use App\Models\HolidayPlan;
use Barryvdh\DomPDF\Facade\Pdf;

use function Pest\Laravel\getJson;

it('should be download a holiday plan pdf', function () {
    $holidayPlan = HolidayPlan::factory()->create();

    getJson(route('plans.pdf', $holidayPlan->id))
        ->assertSuccessful()
        ->assertDownload(str_replace(' ', '_', $holidayPlan->title) . '.pdf');
});

it('should dont download a holiday plan pdf', function () {
    $holidayPlan = HolidayPlan::factory()->create();

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
