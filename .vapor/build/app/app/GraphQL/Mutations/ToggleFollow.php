<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ToggleFollow
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $toggle = $user->followings()->toggle($args['following_id']);

        if (count($toggle['attached'])) {
            return 'attached';
        }

        return 'detached';
    }
}
