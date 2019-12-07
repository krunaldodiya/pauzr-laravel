<?php

namespace App\GraphQL\Mutations;

use App\Comment;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AddComment
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        return Comment::create([
            'id' => $args['id'],
            'text' => $args['text'],
            'user_id' => $user->id,
            'post_id' => $args['post_id']
        ]);
    }
}
