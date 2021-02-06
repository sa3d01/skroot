<?php

namespace App\Mail;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $passwordResetObject;
    protected $user;


    public function __construct(PasswordReset $passwordResetObject)
    {
        $this->passwordResetObject = $passwordResetObject;
        $this->user = User::where('email', $passwordResetObject->email)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.auth.password_reset',
            ['name' => $this->user->name ?? '', 'token' => $this->passwordResetObject->token]);
    }
}
