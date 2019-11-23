<?php

namespace App\GraphQL\Queries;

use App\Chatroom;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ChatroomById
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return Chatroom::with('subscribers', 'chats')->where('id', $args['chatroom_id']);
    }
}
