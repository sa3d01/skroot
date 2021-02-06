<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\Auth\CustomerLoginDTO;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('phone', 'password');
        $user = User::where(['phone' => $request['phone']])->first();

        if (!$user) {
            return response()->json(['code' => 'UserNotFound', 'message' => 'User Not Found.'], 400);
        }
        if (!$user->phone_verified_at) {
            return response()->json(['code' => 'PhoneNotVerified', 'message' => 'User phone did not verified'], 400);
        }

        if (auth()->attempt($credentials)) {
            auth()->loginUsingId($user->id);
            $user->update([
                'fcm_token' => $request['fcm_token'],
                'os' => $request['os'],
                'last_session_id' => session()->getId(),
                'last_login_at' => Carbon::now(),
                'last_ip' => $request->ip(),
            ]);

            return response()->json(new CustomerLoginDTO($user), 200);
        }
        return response()->json(['code' => 'WrongPassword', 'message' => "Please check your password."], 401);
    }

    public function logout(Request $request)
    {
        if ($request->user()->token()->revoke()) {
            $request->user()->update([
                'fcm_token' => null,
            ]);
            return response()->json(['message' => "Logged out successfully."], JsonResponse::HTTP_OK); // 200
        }
        return response()->json(null, JsonResponse::HTTP_UNAUTHORIZED); // 401
    }

}
