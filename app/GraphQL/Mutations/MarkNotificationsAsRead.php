<?php

namespace App\GraphQL\Mutations;

use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Notifications\DatabaseNotification;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class MarkNotificationsAsRead
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return DatabaseNotification::where('id', $args['notification_id'])->update(['read_at' => Carbon::now()]);
    }
}
