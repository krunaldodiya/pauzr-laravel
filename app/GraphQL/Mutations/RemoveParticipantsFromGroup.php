<?php

namespace App\GraphQL\Mutations;

use App\Group;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class RemoveParticipantsFromGroup
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $group = Group::find($args['group_id']);

        $group->subscribers()->detach($args['participant_id']);

        return $group;
    }
}
