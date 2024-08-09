<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Models\HolidayPlan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class Destroy extends Controller
{
    public function __invoke(HolidayPlan $holidayPlan): Response
    {
        Gate::authorize('delete', $holidayPlan);

        $holidayPlan->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
