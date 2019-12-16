<?php

namespace App\GraphQL\Mutations;

use App\Group;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class EditGroup
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        try {
            Group::where('id', $args['id'])
                ->update([
                    'name' => $args['name'],
                    'description' => $args['description'],
                ]);

            return Group::where('id', $args['id'])->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
