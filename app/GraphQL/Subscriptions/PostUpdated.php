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
        // return !!User::find($subscriber->context->user->id)
        //     ->chatrooms()
        //     ->where('id', $subscriber->args['chatroom_id'])
        //     ->count();

        return true;
    }

    public function filter(Subscriber $subscriber, $root)
    {
        // $user = $subscriber->context->user;

        // return $root->sender->id !== $user->id;

        return true;
    }

    public function resolve($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Post
    {
        return $root;
    }
}
