<?php

use App\Http\Controllers\HolidayPlan;
use Illuminate\Support\Facades\Route;

Route::get('/plans', HolidayPlan\GetAll::class)->name('plans.index');
Route::get('/plans/{id}', HolidayPlan\GetById::class)->name('plans.show');
Route::post('/plans/new', HolidayPlan\Store::class)->name('plans.store');
Route::put('/plans/{holidayPlan}/update', HolidayPlan\Update::class)->name('plans.update');
