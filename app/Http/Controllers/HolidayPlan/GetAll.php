<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Models\HolidayPlan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAll extends Controller
{
    public function __invoke(): LengthAwarePaginator
    {
        return HolidayPlan::query()
            ->where('user_id', '=', auth()->user()->id)
            ->paginate();
    }
}
