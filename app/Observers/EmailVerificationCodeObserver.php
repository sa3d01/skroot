<?php

namespace App\Observers;

use App\Mail\UserVerificationMail;
use App\Models\EmailVerificationCode;
use Illuminate\Support\Facades\Mail;

class EmailVerificationCodeObserver
{
    /**
     * Handle the email verification code "created" event.
     *
     * @param EmailVerificationCode $emailVerificationCode
     * @return void
     */
    public function created(EmailVerificationCode $emailVerificationCode)
    {
        Mail::to($emailVerificationCode->user)->queue(new UserVerificationMail($emailVerificationCode));
    }
}
