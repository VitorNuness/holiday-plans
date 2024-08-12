<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Http\Resources\HolidayPlanResource;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;

class Store extends Controller
{
    public function __invoke(Request $request): MessageResource
    {
        $validData = $request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['max:100'],
            'date' => ['required', 'date:YYYY-MM-DD'],
            'location' => ['required', 'max:100'],
            'participants' => ['array'],
        ]);

        $holidayPlan = auth('api')
            ->user()
            ->holidayPlans()
            ->create($validData);
        $message = 'Holiday Plan has been created successfully!';

        return MessageResource::make(
            message: $message,
            data: HolidayPlanResource::make($holidayPlan)
        );
    }
}
