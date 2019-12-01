<?php

namespace App\GraphQL\Queries;

use App\Config;
use App\Country;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetConfig
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $country = Country::where(['shortname' => 'IN'])->first();

        return Config::firstOrCreate([
            'device_id' => $args['device_id']
        ], [
            'device_id' => $args['device_id'],
            'initial_screen' => 'Auth',
            'country_id' => $country->id,
        ]);
    }
}
