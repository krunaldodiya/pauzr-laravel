<?php

namespace App\GraphQL\Mutations;

use App\Repositories\OtpRepositoryInterface;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class VerifyOtp
{
    public $otpRepository;

    public function __construct(OtpRepositoryInterface $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::where('mobile', $args['mobile'])->first();

        return $this->otpRepository->verifyOtp($user, $args['otp']);
    }
}
