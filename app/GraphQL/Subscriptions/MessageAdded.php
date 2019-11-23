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

        return !!User::find($user->id)
            ->chatrooms()
            ->where('id', $subscriber->args['chatroom_id'])
            ->count();
    }

    public function filter(Subscriber $subscriber, $root)
    {
        dump($root);

        $user = $subscriber->context->user;

        return $root->sender->id !== $user->id;
    }

    public function resolve($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $root;
    }
}
