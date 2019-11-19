<?php

namespace App\Http\Controllers;

use App\Exceptions\UserDoesNotExists;
use App\Http\Requests\Signin;
use App\Http\Requests\Signup;
use App\Repositories\UserRepositoryInterface;
use App\User;

class AuthController extends Controller
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function signup(Signup $request)
    {
        $user = User::create($request->all());
        $token = auth()->tokenById($user->id);

        return $this->createToken($user, $token);
    }

    public function signin(Signin $request)
    {
        $email = $request->email;
        $password = $request->password;

        $token = auth()->attempt(['email' => $email, 'password' => $password]);

        if (!$token) {
            throw new UserDoesNotExists('User Does not exists');
        }

        return $this->createToken(auth()->user($token), $token);
    }

    public function createToken($user, $token)
    {
        $user = $this->userRepository->getUserById($user->id);

        return ['token' => $token, 'user' => $user];
    }

    public function getAuthType($username)
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }

        if (is_numeric($username)) {
            return 'mobile';
        }

        return 'username';
    }
}
