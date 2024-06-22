<?php

namespace App\Policies;

use App\Models\Clinic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClinicPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isCustomer();
    }

    public function view(User $user, Clinic $clinic)
    {
        return $user->isAdmin() || $user->isCustomer();
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function store(User $user)
    {
        return $user->isAdmin();
    }

    public function edit(User $user, Clinic $clinic)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Clinic $clinic)
    {
        return $user->isAdmin();
    }
}
