<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Execution\Utils\Subscription;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class TestSubscription
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        Subscription::broadcast('postUpdated', ['name' => 'krunal']);

        return 'hello';
    }
}
