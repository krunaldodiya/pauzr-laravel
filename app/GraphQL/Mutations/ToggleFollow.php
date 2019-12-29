<?php

namespace App\GraphQL\Mutations;

use App\Notifications\UserFollowed;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Notification;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ToggleFollow
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $following = User::find($args['following_id']);

        $toggle = $user->followings()->toggle($following->id);

        if (count($toggle['attached'])) {
            $points = config('points.user_followed');

            $count = $user
                ->transactions()
                ->where('meta->points->following_id', $following->id)
                ->where('meta->points->follower_id', $user->id)
                ->where('meta->points->type', $points['type'])
                ->count();

            if ($count == 0) {
                $transaction = $user->createTransaction($points['points'], 'deposit', [
                    'points' => [
                        'following_id' => $following->id,
                        'follower_id' => $user->id,
                        'type' => $points['type']
                    ]
                ]);

                $user->deposit($transaction->transaction_id);
            }


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
