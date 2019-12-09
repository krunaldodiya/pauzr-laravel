<?php

namespace App\GraphQL\Mutations;

use App\Feed;
use App\Post;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SharePost
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        try {
            Feed::create([
                'post_id' => $args['post_id'], 'user_id' => $user->id, 'type' => "Share"
            ]);

            return Post::with('owner', 'category', 'attachments')
                ->where('id', $args['post_id'])
                ->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
