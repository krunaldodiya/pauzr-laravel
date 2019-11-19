<?php

namespace App\Repositories;

interface OtpRepositoryInterface
{
    public function requestOtp($user);
    public function verifyOtp($user, $otp);
}
