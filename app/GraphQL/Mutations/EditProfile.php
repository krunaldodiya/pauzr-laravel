<?php

namespace App\GraphQL\Mutations;

use App\Repositories\UserRepositoryInterface;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class EditProfile
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        try {
            $authUser = auth()->user();
            $authUser->update($args);

            return $this->userRepository->getUserById($authUser->id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
