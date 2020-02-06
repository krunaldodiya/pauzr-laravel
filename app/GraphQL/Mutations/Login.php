<?php

namespace App\GraphQL\Mutations;

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

        try {
            $token = auth()->attempt([$type => $args['username'], 'password' => $args['password']]);
            $user = JWTAuth::toUser($token);

            return $this->userRepository->createToken($user, $token);
        } catch (\Throwable $th) {
            throw new InvalidCredentials("Login Failed", "Invalid Credentials");
        }
    }
}
