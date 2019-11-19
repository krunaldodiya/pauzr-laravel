<?php

namespace App\GraphQL\Mutations;

use App\Post;
use App\Repositories\UserRepositoryInterface;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreatePost
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $attachments = collect($args['attachments'])
            ->map(function ($attachment) use ($user, $args) {
                $attachment['user_id'] = $user->id;
                $attachment['category_id'] = $args['category_id'];

                return $attachment;
            })
            ->toArray();

        $post = Post::create([
            'id' => $args['id'],
            'user_id' => $user->id,
            'category_id' => $args['category_id'],
            'description' => isset($args['description']) ? $args['description'] : null,
            'type' => $args['type'],
        ]);

        $post->attachments()->createMany($attachments);

        return Post::with('owner', 'category', 'attachments')
            ->where('id', $post->id)
            ->first();
    }
}