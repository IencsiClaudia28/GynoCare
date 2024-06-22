<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return !$user->isDoctor();
    }

    public function view(User $user, Payment $payment)
    {
        if($user->isAdmin())
            return true;

        if($user->isCustomer())
            return true;

        return false;
    }

    public function complete(User $user, Payment $payment)
    {
        return $user->isCustomer() && $payment->status->status == 'PENDING';
    }

    public function refund(User $user, Payment $payment)
    {
        return $user->isAdmin() && $payment->status->status == 'DONE';
    }
}
