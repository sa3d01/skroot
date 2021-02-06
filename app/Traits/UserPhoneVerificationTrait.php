<?php

namespace App\Traits;

use App\Models\PhoneVerificationCode;
use Carbon\Carbon;

trait UserPhoneVerificationTrait
{
    use SmsMarketingUAE;

    protected function createPhoneVerificationCodeForUser($user)
    {
        $data = [
            'user_id' => $user->id,
            'phone' => $user->phone,
            'token' => rand(1111, 9999),
            'expires_at' => Carbon::now()->addMinutes(10),
        ];
        PhoneVerificationCode::create($data);

        //$this->sendSms("Welcome to Skroot ;)",$data["phone"]);

        return $data;
    }

}
