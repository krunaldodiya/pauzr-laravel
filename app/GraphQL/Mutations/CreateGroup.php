<?php

namespace App\GraphQL\Mutations;

use App\Group;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateGroup
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $group = Group::create([
            'name' => $args['name'],
            'description' => $args['description'],
            'owner_id' => $user->id,
        ]);

        $group->subscribers()->attach($user->id);

        return $group;
    }
}
