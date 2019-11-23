<?php

namespace App\GraphQL\Subscriptions;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Http\Request;
use Nuwave\Lighthouse\Schema\Types\GraphQLSubscription;
use Nuwave\Lighthouse\Subscriptions\Subscriber;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class MessageAdded extends GraphQLSubscription
{
    public function authorize(Subscriber $subscriber, Request $request)
    {
        dump($subscriber->context->user);
        dump($subscriber->args);

        return true;
    }

    public function filter(Subscriber $subscriber, $root)
    {
        $user = $subscriber->context->user;

        return $root->sender->id !== $user->id;
    }

    public function resolve($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $root;
    }
}
