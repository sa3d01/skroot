<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\UserRegistrationRequest;
use App\Http\Resources\Auth\UserRegistrationDTO;
use App\Models\User;
use App\Traits\UserPhoneVerificationTrait;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    use UserPhoneVerificationTrait;

    public function register(UserRegistrationRequest $request)
    {
        $data = $request->validated();
        $data['banned'] = false;
        $data['locale'] = "en";
        $data['notification_toggle'] = true;
        $data['last_ip'] = $request->ip();

        $user = User::create($data);
        $role = Role::findOrCreate("CUSTOMER");
        $user->assignRole($role);

        $verificationData = $this->createPhoneVerificationCodeForUser($user);

        //return response()->json(new UserRegistrationDTO($user), 200);
        return response()->json([
            "phone" => $request["phone"],
            "token" => $verificationData['token'], //TODO: remove at production
            "note_ya_Jemmy" => 'the field "token" return only in development mode ya Jemmy so you can test easily'
        ], 200);
    }
}
