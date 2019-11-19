<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\InvalidCredentials;
use App\Repositories\UserRepositoryInterface;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Login
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        try {
            $token = auth('api')->attempt($args);
            $user = auth('api')->user($token);

            return $this->userRepository->createToken($user, $token);
        } catch (\Throwable $th) {
            throw new InvalidCredentials("Invalid Credentials", 402);
        }
    }
}
