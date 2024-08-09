<?php

use App\Models\HolidayPlan;
use App\Models\User;
use Database\Seeders\HolidayPlanSeeder;


use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('should be get holiday plans paginated', function () {
    $user = User::factory()->create();
    HolidayPlan::factory(10)->create(['user_id' => $user]);

    actingAs($user, 'api');

    getJson(route('plans.index'))
        ->assertSuccessful()
        ->assertJsonIsObject();
});

it('should be dont get holiday plans of another user', function () {
    HolidayPlan::factory(10)->create();
    $user = User::factory()->create();

    actingAs($user, 'api');

    $response = getJson(route('plans.index'));

    $response
        ->assertSuccessful()
        ->assertJsonIsObject();
    expect($response['total'])->toBe(0);
});
