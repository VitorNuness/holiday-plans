<?php

use App\Http\Controllers\HolidayPlan;
use Illuminate\Support\Facades\Route;

Route::get('/plans', HolidayPlan\GetAll::class)->name('plans.index');
Route::post('/plans/new', HolidayPlan\Store::class)->name('plans.store');
