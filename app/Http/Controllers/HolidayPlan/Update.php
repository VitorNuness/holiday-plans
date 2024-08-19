<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\HolidayPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Update extends Controller
{
    public function __invoke(HolidayPlan $holidayPlan, Request $request): MessageResource
    {
        Gate::authorize('update', $holidayPlan);

        $validData = $request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['max:100'],
            'date' => ['required', 'date_format:Y-m-d'],
            'location' => ['required', 'max:100'],
            'participants' => ['array'],
        ]);

        $holidayPlan->update($validData);
        $message = "Update has been successfully!";

        return MessageResource::make(
            message: $message,
            data: $holidayPlan
        );
    }
}
