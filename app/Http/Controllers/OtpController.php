<?php

namespace App\Http\Controllers;

use App\Exceptions\UserDoesNotExists;
use App\Http\Requests\RequestOtp;
use App\Http\Requests\VerifyOtp;

use Exception;
use Error;

use App\Repositories\OtpRepositoryInterface;
use App\User;

class OtpController extends Controller
{
    public $otpRepository;

    public function __construct(OtpRepositoryInterface $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    public function requestOtp(RequestOtp $request)
    {
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            throw new UserDoesNotExists('User Does not exists');
        }

        try {
            return $this->otpRepository->requestOtp($user);
        } catch (Exception $e) {
            throw new Error($e->getMessage());
        }
    }

    public function verifyOtp(VerifyOtp $request)
    {
        $user = User::where('mobile', $request->mobile)->first();

        try {
            return $this->otpRepository->verifyOtp($user, $request->otp);
        } catch (Exception $e) {
            throw new Error($e->getMessage());
        }
    }
}
