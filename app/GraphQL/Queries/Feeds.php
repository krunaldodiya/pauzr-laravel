<?php

namespace App\GraphQL\Queries;

use App\Feed;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Feeds
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $authUser = auth()->user();
        $followingIds = $authUser->followings->pluck('id');

        return Feed::with('post.owner', 'post.category', 'post.attachments', 'user')
            ->where(function ($query) use ($authUser, $followingIds) {
                return $query
                    ->where('user_id', $authUser->id)
                    ->orWhereIn('user_id', $followingIds);
            })
            ->whereHas('post', function ($query) {
                return $query->where('published', false);
            })
            ->orderBy('created_at', 'desc');
    }
}
