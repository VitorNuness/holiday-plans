<?php

namespace App\Policies;

use App\Models\HolidayPlan;
use App\Models\User;

class HolidayPlanPolicy
{
    public function view(User $user, HolidayPlan $holidayPlan): bool
    {
        return $user->id === $holidayPlan->user_id;
    }

    public function update(User $user, HolidayPlan $holidayPlan): bool
    {
        return $user->id === $holidayPlan->user_id;
    }

    public function delete(User $user, HolidayPlan $holidayPlan): bool
    {
        return $user->id === $holidayPlan->user_id;
    }

    public function download(User $user, HolidayPlan $holidayPlan): bool
    {
        return $user->id === $holidayPlan->user_id;
    }
}
