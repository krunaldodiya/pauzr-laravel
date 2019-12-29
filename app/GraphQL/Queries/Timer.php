<?php

namespace App\GraphQL\Queries;

use App\User;
use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Timer
{
    public function getTimerRankings($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $period = $this->filterPeriod($args['period']);

        return User::all();
    }

    public function filterPeriod($period)
    {
        if ($period == 'Today') {
            return Carbon::now()->startOfDay();
        }

        if ($period == 'This Week') {
            return Carbon::now()->startOfWeek();
        }

        if ($period == 'This Month') {
            return Carbon::now()->startOfMonth();
        }
    }
}
