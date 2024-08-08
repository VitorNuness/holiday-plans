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
            'title' => ['required', 'max:50'],
            'description' => ['max:100'],
            'date' => ['required'],
        ]);

        return HolidayPlan::query()
            ->create($validData);
    }
}
