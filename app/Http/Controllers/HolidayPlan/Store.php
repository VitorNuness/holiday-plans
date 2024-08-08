<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Models\HolidayPlan;
use Illuminate\Http\Request;

class Store extends Controller
{
    public function __invoke(Request $request)
    {
        $validData = $request->validate([
            'title' => ['required'],
        ]);

        return HolidayPlan::query()
            ->create($validData);
    }
}
