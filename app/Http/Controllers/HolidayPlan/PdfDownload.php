<?php

namespace App\Http\Controllers\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Models\HolidayPlan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfDownload extends Controller
{
    public function __invoke(HolidayPlan $holidayPlan): Response
    {
        $pdf = Pdf::loadView('pdf.holiday-plan', ["data" => $holidayPlan]);
        return $pdf->download('holiday_plan.pdf');
    }
}
