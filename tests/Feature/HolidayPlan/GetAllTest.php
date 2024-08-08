<?php

use App\Models\User;
use Database\Seeders\HolidayPlanSeeder;
use Laravel\Passport\Passport;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('should be get holiday plans paginated', function () {
    (new HolidayPlanSeeder)->run();
    $user = User::factory()->create();

    actingAs($user, 'api');

    getJson(route('plans.index'))
        ->assertSuccessful()
        ->assertJsonIsObject();
});
