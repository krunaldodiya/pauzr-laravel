<?php

namespace App\GraphQL\Queries;

use App\Post;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetPostDetail
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return Post::where('id', $args['post_id'])->first();
    }
}
