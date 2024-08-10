<?php

namespace App\Http\Resources;

use App\Models\HolidayPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HolidayPlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'location' => $this->location,
            'participants' => $this->participants,
            'created_by' => UserResource::make($this->user),
        ];
    }
}
