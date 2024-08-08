<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Models\HolidayPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Destroy extends Controller
{
    public function __invoke(HolidayPlan $holidayPlan): Response
    {
        $holidayPlan->deleteOrFail();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
