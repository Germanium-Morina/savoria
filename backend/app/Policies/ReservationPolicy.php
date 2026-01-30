<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;

class ReservationPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Reservation $reservation)
    {
        return $user->hasRole('admin') || $user->id === $reservation->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Reservation $reservation)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Reservation $reservation)
    {
        return $user->hasRole('admin');
    }
}
