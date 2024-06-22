<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use App\Models\AppointmentStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Appointment $appointment)
    {
        if($user->isAdmin())
            return true;
        if($user->isDoctor()){
            if(!empty($appointment->doctor) && $appointment->doctor->id == $user->id)
                return true;

            if(empty($appointment->doctor) && $appointment->clinic->id == $user->clinic_id)
                return true;
        }

        if($user->isCustomer())
            return true;

        return false;
    }

    public function create(User $user)
    {
        return $user->isCustomer();
    }

    public function store(User $user)
    {
        return $user->isCustomer();
    }

    public function accept(User $user, Appointment $appointment)
    {
        if(!$user->isDoctor())
            return false;
    
        if(!empty($appointment->doctor) && $appointment->doctor->id == $user->id)
            return true;

        if(empty($appointment->doctor) && $appointment->clinic->id == $user->clinic_id)
            return true;

        return false;
    }

    public function decline(User $user, Appointment $appointment)
    {
        return $user->isDoctor() && !empty($appointment->doctor) && $appointment->doctor->id == $user->id;
    }

    public function complete(User $user, Appointment $appointment)
    {
        return $user->isDoctor() && !empty($appointment->doctor) && $appointment->doctor->id == $user->id && $appointment->status->status == AppointmentStatus::getAcceptedValue()->status;
    }
}
