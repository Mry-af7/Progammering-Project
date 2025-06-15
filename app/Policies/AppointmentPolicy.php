<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;

class AppointmentPolicy
{
    public function view(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->user_id || $user->id === $appointment->company->user_id;
    }

    public function update(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->user_id || $user->id === $appointment->company->user_id;
    }

    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->user_id || $user->id === $appointment->company->user_id;
    }
} 