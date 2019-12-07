<?php

namespace App\GraphQL\Mutations;

use App\Comment;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AddPostComment
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        return Comment::create([
            'id' => $args['id'],
            'text' => $args['text'],
            'post_id' => $args['post_id'],
            'user_id' => $user->id,
        ]);
    }
}
