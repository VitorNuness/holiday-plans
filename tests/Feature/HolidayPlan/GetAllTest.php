<?php

use Database\Seeders\HolidayPlanSeeder;

use function Pest\Laravel\get;
use function Pest\Laravel\getJson;

it('should be get holiday plans paginated', function () {
    (new HolidayPlanSeeder)->run();

    getJson(route('plans.index'))
        ->assertSuccessful()
        ->assertJsonIsObject();
});
