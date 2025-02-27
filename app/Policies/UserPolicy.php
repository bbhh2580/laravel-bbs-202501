<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * User Profile Policy, Only the user himself can edit his profile
     *
     * @param User $currenUser
     * @param User $user
     * @return bool
     */
    public function update(User $currenUser, User $user): bool
    {
        return $currenUser->id === $user->id;
    }
}
