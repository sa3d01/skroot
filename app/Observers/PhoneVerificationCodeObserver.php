<?php

namespace App\Observers;

use App\Models\PhoneVerificationCode;

class PhoneVerificationCodeObserver
{
    public function created(PhoneVerificationCode $phoneVerificationCode)
    {
        //TODO: send sms code here
    }
}
