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
        $args['username'] = User::generate_username($args['name']);

        if ($user = User::create($args)) {
            $token = auth('api')->tokenById($user->id);

            return $this->userRepository->createToken($user, $token);
        }
    }
}
