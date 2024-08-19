<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Http\Resources\HolidayPlanResource;
use App\Models\HolidayPlan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetAll extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $holidayPlans = auth('api')
            ->user()
            ->holidayPlans()
            ->orderBy('date')
            ->paginate();

        return HolidayPlanResource::collection($holidayPlans);
    }
}
