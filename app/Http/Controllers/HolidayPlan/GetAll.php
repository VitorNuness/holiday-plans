<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Models\HolidayPlan;

class GetAll extends Controller
{
    public function __invoke()
    {
        return HolidayPlan::query()->paginate();
    }
}
