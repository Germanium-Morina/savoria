<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Order $order)
    {
        return $user->hasRole('admin') || $user->id === $order->user_id;
    }

    public function create(User $user)
    {
        return true; // any authenticated user can create an order
    }

    public function update(User $user, Order $order)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Order $order)
    {
        return $user->hasRole('admin');
    }
}
