<?php

namespace App\Repositories;

use App\User;
use Error;

class OtpRepository implements OtpRepositoryInterface
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    private function generateUrl($type, $country, $mobile, $otp, $message)
    {
        $base_url = "https://control.msg91.com/api";
        $authKey = config('msg91.auth_key');
        $mwc = $country['phonecode'] . $mobile;

        if ($type == 'request_otp') {
            return "$base_url/sendotp.php?authkey=$authKey&mobile=$mwc&otp=$otp&message=$message";
        }

        if ($type == 'verify_otp') {
            return "$base_url/verifyRequestOTP.php?authkey=$authKey&mobile=$mwc&otp=$otp";
        }
    }

    public function requestOtp($country, $mobile)
    {
        $app_name = config('app.name');
        $otp = mt_rand(1000, 9999);

        $message = "$otp is Your otp for phone verification for $app_name.";
        $url = $this->generateUrl("request_otp", $country, $mobile, $otp, $message);

        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $body = json_decode($response->getBody());

        if ($body->type == "success") {
            return $otp;
        }

        throw new Error($body->message);
    }

    public function verifyOtp($country, $mobile, $otp)
    {

        $url = $this->generateUrl("verify_otp", $country, $mobile, $otp, null);
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $body = json_decode($response->getBody());

        if ($body->type == "success") {
            return true;
        }

        throw new Error($body->message);
    }
}
