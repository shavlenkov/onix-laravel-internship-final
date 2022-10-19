<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use App\Models\Answer;

use Illuminate\Auth\Access\HandlesAuthorization;


class AnswerPolicy
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

    public function create(User $user) {
        return $user->isAdmin();
    }

    public function update(User $user, Answer $answer) {
        return $user->isAdmin() && $user->id == $answer->user_id;
    }

    public function delete(User $user, Answer $answer) {
        return $user->isAdmin() && $user->id == $answer->user_id;
    }
}
