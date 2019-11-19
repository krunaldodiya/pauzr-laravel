<?php

namespace App\Repositories;

use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function createToken($user, $token)
    {
        $user = $this->getUserById($user->id);

        return ['token' => $token, 'user' => $user];
    }

    public function getUserById($user_id)
    {
        return User::with('country')->where('id', $user_id)->firstOrFail();
    }
}
