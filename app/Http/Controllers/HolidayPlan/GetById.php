<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Models\HolidayPlan;

class GetById extends Controller
{
    public function __invoke(string | int $id): ?HolidayPlan
    {
        return HolidayPlan::query()->findOrFail($id);
    }
}
