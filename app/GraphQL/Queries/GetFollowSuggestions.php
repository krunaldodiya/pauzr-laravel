<?php

namespace App\GraphQL\Queries;

use App\User;
use App\UserContact;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetFollowSuggestions
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $already_following = $user->followings->pluck('following_id');

        $post_like_wise = $user->favorites->pluck('user_id');
        $contact_wise = UserContact::where('user_id', $user->id)->pluck('mobile_cc');

        return User::where('id', '!=', $user->id)
            ->where('status', true)
            ->where(function ($query) use ($post_like_wise, $contact_wise) {
                return $query
                    ->whereIn('id', $post_like_wise)
                    ->orWhereIn('mobile_cc', $contact_wise);
            })
            ->whereNotIn('id', $already_following)
            ->get();
    }
}
