<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user, User $model)
    {
        return $user->isAdmin() || $user->id === $model->id;
    }

    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function store(User $user)
    {
        return $user->isAdmin();
    }

    public function edit(User $user, User $model)
    {
        return $user->isAdmin() || $user->id === $model->id;
    }

    public function update(User $user, User $model)
    {
        return $user->isAdmin() || $user->id === $model->id;
    }
}
