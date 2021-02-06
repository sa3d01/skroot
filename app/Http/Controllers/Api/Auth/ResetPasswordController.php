<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\PasswordReset\ForgotPasswordRequest;
use App\Http\Requests\Api\Auth\PasswordReset\ResendForgotPasswordRequest;
use App\Http\Requests\Api\Auth\PasswordReset\SetPasswordRequest;
use App\Http\Resources\Auth\CustomerLoginDTO;
use App\Models\PasswordReset;
use App\Models\User;
use App\Traits\UserPasswordResetTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    use UserPasswordResetTrait;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('phone', $request['phone'])->first();
        $passResetData = $this->createPasswordResetCodeForUser($user);

        //return response()->json(['message' => 'Password reset token has been sent to your phone.'], 200);
        return response()->json([
            'message' => 'Password reset token has been sent to your phone.',
            "token" => $passResetData['token'], //TODO: remove at production
            "note_ya_Jemmy" => 'the field "token" return only in development mode ya Jemmy so you can test easily'
        ], 200);
    }

    public function resend(ResendForgotPasswordRequest $request)
    {
        $user = User::where('phone', $request['phone'])->first();
        $this->createPasswordResetCodeForUser($user);
        return response()->json(['message' => 'Password reset token has been sent to your phone.'], 200);
    }

    public function checkToken(ForgotPasswordRequest $request)
    {
        $passwordResetObject = PasswordReset::where([
            'phone' => $request['phone'],
            'token' => $request['token'],
        ])->first();
        if (!$passwordResetObject) {
            return response()->json(['field' => 'token', 'message' => 'Wrong token! Please try again.'], 422);
        }
        if (Carbon::now()->gt(Carbon::parse($passwordResetObject->expires_at))) {
            return response()->json(['field' => 'token', 'message' => 'Token expired. Please request a new one.'], 422);
        }
        return response()->json(['message' => 'Phone and token match successfully.'], 200);
    }

    public function setNewPassword(SetPasswordRequest $request)
    {
        $passwordResetObject = PasswordReset::where([
            'phone' => $request['phone'],
            'token' => $request['token'],
        ])->first();
        if (!$passwordResetObject) {
            return response()->json(['field' => 'token', 'message' => 'Wrong token! Please try again.'], 422);
        }
        if (Carbon::now()->gt(Carbon::parse($passwordResetObject->expires_at))) {
            return response()->json(['field' => 'token', 'message' => 'Token expired. Please request a new one.'], 422);
        }

        $user = User::where('phone', $request['phone'])->first();
        DB::transaction(function () use ($user, $passwordResetObject, $request) {
            $passwordResetObject->update(['reset_at' => Carbon::now()]);
            $user->update(['password' => $request['password']]);
        });

        //return response()->json(['message' => 'Password set successfully.'], 200);
        return response()->json(new CustomerLoginDTO($user), 200);
    }

}
