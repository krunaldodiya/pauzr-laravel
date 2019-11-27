<?php

namespace App\GraphQL\Mutations;

use App\Notifications\UserFollowed;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Notifications\Notification;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ToggleFollow
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $following = User::find($args['following_id']);

        $toggle = $user->followings()->toggle($following->id);

        if (count($toggle['attached'])) {
            Notification::send($following, new UserFollowed($following->toArray(), $user->toArray()));

            return 'attached';
        }

        $user->notifications()
            ->where('data->following_id', $following->id)
            ->where('data->follower_id', $user->id)
            ->delete();

        return 'detached';
    }
}
