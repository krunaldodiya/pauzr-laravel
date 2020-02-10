<?php

namespace App\GraphQL\Mutations;

use App\Country;
use App\Exceptions\ValidationFailed;
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
            $exists = User::where(['country_id' => $country->id, 'mobile' => $args['mobile']])->first();

            if ($exists) {
                throw new ValidationFailed("Request OTP Failed", [['mobile' => "Account already exists"]]);
            }
        }

        return $this->otpRepository->requestOtp($country, $args['mobile']);
    }
}
