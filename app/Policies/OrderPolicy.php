<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user) {
        return $user->isAdmin() || $user->isUser();
    }

    public function view(User $user) {
        return $user->isAdmin() || $user->isUser();
    }

    public function create(User $user) {
        return $user->isUser();
    }

    public function update(User $user, Order $order) {
        return $user->isAdmin() || ($user->isUser() && $user->id == $order->user_id);
    }

    public function delete(User $user, Order $order) {
        return $user->isAdmin() || ($user->isUser() && $user->id == $orde->user_id);
    }

}
