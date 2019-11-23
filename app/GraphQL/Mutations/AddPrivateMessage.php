<?php

namespace App\GraphQL\Mutations;

use App\Chat;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Execution\Utils\Subscription;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AddPrivateMessage
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $authUser = auth()->user();

        $chat_created = Chat::create([
            'text' => $args['text'],
            'sender_id' => $authUser->id
        ]);

        $chat = Chat::with('sender', 'chatroom')->where('id', $chat_created->id)->first();

        Subscription::broadcast('messageAdded', $chat);
    }
}
