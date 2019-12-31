<?php

namespace App\GraphQL\Mutations;

use App\Post;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class DeletePost
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return Post::where('id', $args['post_id'])->delete();
    }
}
