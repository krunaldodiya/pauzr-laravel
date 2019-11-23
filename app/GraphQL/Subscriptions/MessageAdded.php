<?php

namespace App\GraphQL\Subscriptions;

use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Http\Request;
use Nuwave\Lighthouse\Schema\Types\GraphQLSubscription;
use Nuwave\Lighthouse\Subscriptions\Subscriber;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class MessageAdded extends GraphQLSubscription
{
    public function authorize(Subscriber $subscriber, Request $request)
    {
        $user = $subscriber->context->user;
        $args = $subscriber->args;

        return !!User::find($user->id)
            ->chatrooms()
            ->where('id', $args['chatroom_id'])
            ->count();
    }

    public function filter(Subscriber $subscriber, $root)
    {
        return true;
    }

    public function resolve($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $root;
    }
}
