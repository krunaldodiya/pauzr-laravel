<?php

namespace App\GraphQL\Mutations;

use App\Reply;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AddCommentReply
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        return Reply::create([
            'id' => $args['id'],
            'text' => $args['text'],
            'post_id' => $args['post_id'],
            'comment_id' => $args['comment_id'],
            'user_id' => $user->id,
        ]);
    }
}
