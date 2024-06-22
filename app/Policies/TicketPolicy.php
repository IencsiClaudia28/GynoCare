<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Ticket $ticket)
    {
        return $user->isAdmin() || $user->id == $ticket->reporter->id;
    }

    public function create(User $user)
    {
        return !$user->isAdmin();
    }

    public function store(User $user)
    {
        return !$user->isAdmin();
    }

    public function update(User $user, Ticket $ticket)
    {
        return $user->isAdmin();
    }
}
