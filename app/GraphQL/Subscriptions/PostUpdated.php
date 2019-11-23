<?php

namespace App\GraphQL\Subscriptions;

use App\Post;

use Illuminate\Http\Request;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Subscriptions\Subscriber;
use Nuwave\Lighthouse\Schema\Types\GraphQLSubscription;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PostUpdated extends GraphQLSubscription
{
    public function authorize(Subscriber $subscriber, Request $request)
    {
        // $user = $subscriber->context->user;
        // $args = $subscriber->args;

        // return !!User::find($user->id)
        //     ->chatrooms()
        //     ->where('id', $args['chatroom_id'])
        //     ->count();

        return true;
    }

    public function filter(Subscriber $subscriber, $root)
    {
        // $user = $subscriber->context->user;
        // $args = $subscriber->args;

        // return $root->sender->id !== $user->id;

        return true;
    }

    public function resolve($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Post
    {
        return $root;
    }
}
