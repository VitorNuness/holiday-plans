<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Models\HolidayPlan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class PdfDownload extends Controller
{
    public function __invoke(HolidayPlan $holidayPlan): Response
    {
        Gate::authorize('download', $holidayPlan);

        $pdf = Pdf::loadView('pdf.holiday-plan', ['data' => $holidayPlan]);

        return $pdf->download('holiday_plan.pdf');
    }
}
