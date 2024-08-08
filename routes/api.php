<?php

use App\Http\Controllers\HolidayPlan;
use Illuminate\Support\Facades\Route;

Route::post('/plans/new', HolidayPlan\Store::class)->name('plans.store');
