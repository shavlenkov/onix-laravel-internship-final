<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
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

    public function update(User $user, Question $question) {
        return $user->isUser() && $user->id == $question->user_id;
    }

    public function delete(User $user, Question $question) {
        return $user->isUser() && $user->id == $question->user_id;
    }

}
