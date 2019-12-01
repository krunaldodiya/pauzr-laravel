<?php

namespace App\GraphQL\Mutations;

use App\Config;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SetConfig
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $update = Config::where(['id' => $args['id']])->update($args);

        if ($update) {
            return Config::find($args['id']);
        }
    }
}
