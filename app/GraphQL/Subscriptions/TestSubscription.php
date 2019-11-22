<?php

namespace App\GraphQL\Subscriptions;

use Illuminate\Http\Request;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Subscriptions\Subscriber;
use Nuwave\Lighthouse\Schema\Types\GraphQLSubscription;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class TestSubscription extends GraphQLSubscription
{
    public function authorize(Subscriber $subscriber, Request $request): bool
    {
        return true;
    }

    public function filter(Subscriber $subscriber, $root): bool
    {
        return false;
    }

    public function resolve($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $root;
    }
}
