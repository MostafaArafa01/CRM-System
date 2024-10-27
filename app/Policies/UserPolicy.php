<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */

    public function update(User $user, User $targetUser){
        return $user->id === $targetUser->id;
    }

    public function delete(User $user, User $targetUser){
        return $user->id === $targetUser->id;
    }
    public function __construct()
    {
        //
    }
}
