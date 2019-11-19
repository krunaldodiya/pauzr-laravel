<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function createToken($user, $token);
    public function getUserById($user_id);
}
