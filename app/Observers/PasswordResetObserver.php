<?php

namespace App\Observers;

use App\Mail\PasswordResetMail;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;

class PasswordResetObserver
{
    public function created(PasswordReset $passwordResetObject)
    {
        //Mail::to($passwordResetObject->email)->queue(new PasswordResetMail($passwordResetObject));
    }
}
