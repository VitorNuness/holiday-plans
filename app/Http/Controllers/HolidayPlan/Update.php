<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Models\HolidayPlan;
use Illuminate\Http\Request;

class Update extends Controller
{
    public function __invoke(HolidayPlan $holidayPlan, Request $request): HolidayPlan
    {
        $validData = $request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['max:100'],
            'date' => ['required', 'date:YYYY-MM-DD'],
            'location' => ['required', 'max:100'],
            'participants' => ['array'],
        ]);

        $holidayPlan->update($validData);

        return $holidayPlan;
    }
}
