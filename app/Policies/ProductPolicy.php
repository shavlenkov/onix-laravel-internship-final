<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
        return $user->isAdmin();
    }

    public function update(User $user) {
        return $user->isAdmin();
    }

    public function delete(User $user) {
        return $user->isAdmin();
    }

}
