<?php

namespace App\GraphQL\Queries;

use App\Chatroom;
use App\User;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PrivateChatroom
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $authUser = auth()->user();
        $friend = User::find($args['friend_id']);

        $chatroom = $authUser
            ->chatrooms()
            ->where(function ($query) use ($friend) {
                return $query
                    ->where('chatroom_type', "Private")
                    ->whereHas('subscribers', function ($query) use ($friend) {
                        return $query->where("id", $friend->id);
                    });
            })
            ->first();

        if ($chatroom) {
            return $chatroom;
        }

        $chatroom = Chatroom::create([
            'chatroom_name' => "{$friend->name} & {$authUser->name}",
            'chatroom_type' => "Private"
        ]);

        $chatroom->subscribers()->attach([$friend->id, $authUser->id]);

        return Chatroom::with('subscribers', 'chats')->where('id', $chatroom->id)->first();
    }
}
