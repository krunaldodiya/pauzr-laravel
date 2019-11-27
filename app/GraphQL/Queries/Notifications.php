<?php

namespace App\GraphQL\Queries;

use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Notifications
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth('api')->user();

        return $user
            ->notifications
            ->where('created_at', '>', Carbon::now()->subDays(60));
    }
}
