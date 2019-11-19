<?php

namespace App\GraphQL\Queries;

use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SearchUsers
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return User::with('followers', 'followings', 'country')
            ->where(function ($query) use ($args) {
                $keywords = $args['keywords'];

                return $query
                    ->where('name', 'ILIKE', "%$keywords%")
                    ->orWhere('username', 'ILIKE', "%$keywords%");
            });
    }
}
