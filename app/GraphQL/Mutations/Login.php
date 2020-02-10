<?php

namespace App\GraphQL\Mutations;

use App\User;

use App\Exceptions\InvalidCredentials;
use App\Repositories\UserRepositoryInterface;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Tymon\JWTAuth\Facades\JWTAuth;

class Login
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $type = filter_var($args['username'], FILTER_VALIDATE_EMAIL) ? "email" : "username";
        $credentials = [$type => $args['username'], 'password' => $args['password']];

        try {
            if (auth()->attempt($credentials)) {
                $user =   User::where([$type => $args['username']])->first();
                $token = JWTAuth::fromUser($user);

                return $this->userRepository->createToken($user, $token);
            }

            return response(['validation' => ['username' => ['Invalid Credentials']]], 402);
            // throw new InvalidCredentials("Login Failed", "Invalid Credentials");
        } catch (\Throwable $th) {
            throw new InvalidCredentials("Login Failed", "Invalid Credentials");
        }
    }
}
