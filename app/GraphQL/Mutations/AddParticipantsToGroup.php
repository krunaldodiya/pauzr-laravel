<?php

namespace App\GraphQL\Mutations;

use App\Group;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AddParticipantsToGroup
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $group = Group::where('id', $args['group_id'])->first();

        $group->subscribers()->attach($args['participant_ids']);

        return $group;
    }
}
