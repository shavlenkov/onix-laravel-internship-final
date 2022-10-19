<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
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
        return $user->isUser();
    }

    public function create(User $user) {
        return $user->isUser();
    }

    public function delete(User $user) {
        return $user->isUser();
    }
}
