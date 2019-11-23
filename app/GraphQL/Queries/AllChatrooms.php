<?php

namespace App\GraphQL\Queries;

use App\Chatroom;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AllChatrooms
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $chatroomIds = auth()->user()->chatrooms->pluck('id');

        return Chatroom::with('subscribers', 'chats')
            ->whereIn('id', $chatroomIds)
            ->get();
    }
}
