<?php

namespace App\GraphQL\Mutations;

use App\Reply;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AddReply
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        return Comment::create([
            'id' => $args['id'],
            'text' => $args['text'],
            'user_id' => $user->id,
            'post_id' => $args['post_id'],
            'comment_id' => $args['comment_id'],
        ]);
    }
}
