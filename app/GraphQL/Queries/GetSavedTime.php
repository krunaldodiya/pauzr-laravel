<?php

namespace App\GraphQL\Queries;

use App\Timer;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetSavedTime
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        return Timer::where('user_id', $user->id)->get();
    }
}
