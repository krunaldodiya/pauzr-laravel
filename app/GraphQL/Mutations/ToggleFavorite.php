<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ToggleFavorite
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $toggle = $user->favorites()->toggle($args['post_id']);

        if (count($toggle['attached'])) {
            $points = config('points.post_favorited');

            $count = $user
                ->transactions()
                ->where('meta->points->id', $args['post_id'])
                ->where('meta->points->type', $points['type'])
                ->count();

            if ($count == 0) {
                $transaction = $user->createTransaction($points['points'], 'deposit', [
                    'points' => [
                        'id' => $args['post_id'],
                        'type' => $points['type']
                    ]
                ]);

                $user->deposit($transaction->transaction_id);
            }

            return 'attached';
        }

        return 'detached';
    }
}
