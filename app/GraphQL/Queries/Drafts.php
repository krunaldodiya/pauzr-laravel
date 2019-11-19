<?php

namespace App\GraphQL\Queries;

use App\Post;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Drafts
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return Post::with('owner', 'category', 'attachments')
            ->where('published', false)
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
