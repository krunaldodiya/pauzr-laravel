<?php

namespace App\GraphQL\Mutations;

use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ResetPassword
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $data = [
            'country_id' => $args['country_id'],
            'mobile' => $args['mobile']
        ];

        try {
            $user = User::where($data)->update(['password' => bcrypt($args['password'])]);

            if ($user) {
                return true;
            }

            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
