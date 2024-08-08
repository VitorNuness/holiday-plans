<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\HolidayPlan;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', Auth\Register::class)->name('auth.register');
Route::post('auth/login', Auth\Login::class)->name('auth.login');

Route::middleware('auth:api')->group(function () {
    Route::get('/plans', HolidayPlan\GetAll::class)->name('plans.index');
    Route::get('/plans/{id}', HolidayPlan\GetById::class)->name('plans.show');
    Route::post('/plans/new', HolidayPlan\Store::class)->name('plans.store');
    Route::put('/plans/{holidayPlan}/update', HolidayPlan\Update::class)->name('plans.update');
    Route::delete('/plans/{holidayPlan}/delete', HolidayPlan\Destroy::class)->name('plans.destroy');
    Route::get('/plans/{holidayPlan}/pdf', HolidayPlan\PdfDownload::class)->name('plans.pdf');
});
