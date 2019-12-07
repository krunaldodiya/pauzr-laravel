<?php

namespace App\GraphQL\Queries;

use App\Comment;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetComments
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return Comment::with('replies')->where('post_id', $args['post_id']);
    }
}
