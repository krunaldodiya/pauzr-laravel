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
            'chatroom_id' => $args['chatroom_id'],
            'sender_id' => $authUser->id,
        ]);

        $chat = Chat::with('sender', 'chatroom')->where('id', $chat_created->id)->first();

        dump($chat);

        Subscription::broadcast('messageAdded', $chat);

        return $chat;
    }
}
