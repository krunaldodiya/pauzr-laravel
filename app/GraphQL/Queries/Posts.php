<?php

namespace App\GraphQL\Queries;

use App\Post;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Posts
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $authUser = auth()->user();
        $followingIds = $authUser->followings->pluck('id');

        return Post::with('owner', 'category', 'attachments')
            ->where('published', true)
            ->where(function ($query) use ($authUser, $followingIds) {
                return $query
                    ->where('user_id', $authUser->id)
                    ->orWhereIn('user_id', $followingIds);
            })
            ->orderBy('created_at', 'desc')
            ->paginate();
    }
}
