<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClinicReview;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClinicReviewPolicy
{
    use HandlesAuthorization;

    public function store(User $user, Clinic $clinic) {
       
        $canLeaveReview = true;
       
        if(!$user->isCustomer())
           $canLeaveReview = false;
        else {

            $userCompletedAppointments = $user->appointments()
                                ->where([
                                    'clinic_id' => $clinic->id,
                                    'appointment_status_id' => 'COMPLETED'
                                ])
                                ->get();
            
            if($userCompletedAppointments->isEmpty()) 
                $canLeaveReview = false;

            if($canLeaveReview){
                
                $reviewAlreadyLeft = ClinicReview::where([
                    'reviewer_id' => $user->id,
                    'clinic_id' => $clinic->id
                ])->count() >= 1;

                if($reviewAlreadyLeft)
                    $canLeaveReview = false;
            };
        }

        return $canLeaveReview;
    }

}
