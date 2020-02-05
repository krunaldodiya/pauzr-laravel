<?php

namespace App\Repositories;

interface OtpRepositoryInterface
{
    public function requestOtp($country, $mobile);
    public function verifyOtp($country, $mobile, $otp);
}
