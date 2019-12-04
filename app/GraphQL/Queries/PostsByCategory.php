<?php

namespace App\GraphQL\Queries;

use App\Post;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PostsByCategory
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $category_id = $args['category_id'];

        return Post::with('owner', 'category', 'attachments')
            ->where('category_id', $category_id)
            ->orderBy('created_at', 'desc');
    }
}
