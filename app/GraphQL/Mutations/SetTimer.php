<?php

namespace App\GraphQL\Mutations;

use App\Timer;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SetTimer
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $duration = strval($args['duration']);
        $points = config("points.timer_$duration");

        $user = auth()->user();

        $timer = Timer::create([
            'user_id' => $user->id,
            'duration' => $duration,
            'country_id' => $user->country_id,
        ]);

        $transaction = $user->createTransaction($points['points'], 'deposit', [
            'points' => [
                'id' => $timer->id,
                'type' => $points['type']
            ]
        ]);

        $user->deposit($transaction->transaction_id);

        return $timer;
    }
}
