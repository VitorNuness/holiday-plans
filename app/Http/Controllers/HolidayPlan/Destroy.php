<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\HolidayPlan;
use Illuminate\Support\Facades\Gate;

class Destroy extends Controller
{
    public function __invoke(HolidayPlan $holidayPlan): MessageResource
    {
        Gate::authorize('delete', $holidayPlan);

        $holidayPlan->delete();
        $message = "Delete has been successfully.";

        return MessageResource::make(
            message: $message,
            data: []
        );
    }
}
