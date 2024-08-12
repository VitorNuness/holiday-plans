<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Http\Resources\HolidayPlanResource;
use App\Models\HolidayPlan;
use Illuminate\Support\Facades\Gate;

class GetById extends Controller
{
    public function __invoke(HolidayPlan $holidayPlan): HolidayPlanResource
    {
        Gate::authorize('view', $holidayPlan);

        return HolidayPlanResource::make($holidayPlan);
    }
}
