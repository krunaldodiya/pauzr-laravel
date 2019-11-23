<?php

namespace App\GraphQL\Subscriptions;

use App\Chat;
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
        return true;
    }

    public function filter(Subscriber $subscriber, $root)
    {
        return true;
    }

    public function resolve($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $chat = Chat::with('sender')->where('id', $root->id)->first();

        dump($chat);

        return $chat;
    }
}
