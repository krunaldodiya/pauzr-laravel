<?php

namespace App\GraphQL\Mutations;

use App\Country;
use App\User;

use App\Repositories\OtpRepositoryInterface;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class RequestOtp
{
    public $otpRepository;

    public function __construct(OtpRepositoryInterface $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $country = Country::find($args['country_id']);

        if ($args['type'] === 'register') {
            $exists = User::where(['mobile' => $args['mobile']])->first();

            if ($exists) {
                return response(['error' => 'Account already exists'], 400);
            }

            return $this->otpRepository->requestOtp($country, $args['mobile']);
        }

        return $this->otpRepository->requestOtp($country, $args['mobile']);
    }
}
