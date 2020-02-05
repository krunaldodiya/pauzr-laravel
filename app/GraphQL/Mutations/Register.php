<?php

namespace App\GraphQL\Mutations;

use App\Repositories\UserRepositoryInterface;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Register
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $args['email'] = "{$args['username']}@pauzr.com";

        if ($user = User::create($args)) {
            $token = auth()->attempt($args);
            $user = auth()->user($token);

            return $this->userRepository->createToken($user, $token);
        }
    }
}
