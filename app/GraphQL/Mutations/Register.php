<?php

namespace App\GraphQL\Mutations;

use App\Repositories\UserRepositoryInterface;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Tymon\JWTAuth\Facades\JWTAuth;

class Register
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::create([
            'mobile' => $args['mobile'],
            'country_id' => $args['country_id'],
            'name' => $args['name'],
            'username' => $args['username'],
            'email' => "{$args['username']}@pauzr.com",
            'password' => bcrypt($args['password']),
        ]);

        if ($user) {
            $token = JWTAuth::fromUser($user);
            return $this->userRepository->createToken($user, $token);
        }
    }
}
