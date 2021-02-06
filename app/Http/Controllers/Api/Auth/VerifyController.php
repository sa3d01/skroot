<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ResendPhoneVerificationRequest;
use App\Http\Requests\Api\Auth\VerifyPhoneRequest;
use App\Http\Resources\Auth\CustomerLoginDTO;
use App\Models\PhoneVerificationCode;
use App\Models\User;
use App\Traits\UserPhoneVerificationTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VerifyController extends Controller
{
    use UserPhoneVerificationTrait;

    public function resendPhoneVerification(ResendPhoneVerificationRequest $request)
    {
        $user = User::where('phone', $request['phone'])->first();
        if ($user->phone_verified_at != null) {
            return response()->json(['field' => 'phone', 'message' => 'This phone already validated before. You can login.'], 422);
        }
        $this->createPhoneVerificationCodeForUser($user);
        return response()->json(['message' => 'Verification token has been sent to your phone.'], 200);
    }

    public function verifyPhone(VerifyPhoneRequest $request)
    {
        $user = User::where('phone', $request['phone'])->first();
        if ($user->phone_verified_at != null) {
            return response()->json(['field' => 'phone', 'message' => 'This phone already validated before. You can login.'], 422);
        }

        $verificationCode = PhoneVerificationCode::where([
            'phone' => $request['phone'],
            'token' => $request['token'],
        ])->first();
        if (!$verificationCode) {
            return response()->json(['field' => 'token', 'message' => 'Wrong token! Please try again.'], 422);
        }
        if (Carbon::now()->gt(Carbon::parse($verificationCode->expires_at))) {
            return response()->json(['field' => 'token', 'message' => 'Code expired. Please request a new token.'], 422);
        }

        DB::transaction(function () use ($user, $verificationCode) {
            $now = Carbon::now();
            $verificationCode->update(['verified_at' => $now]);
            $user->update(['phone_verified_at' => $now]);
        });

        //return response()->json(['message' => 'Phone verified successfully.'], 200);
        return response()->json(new CustomerLoginDTO($user), 200);
    }

}
