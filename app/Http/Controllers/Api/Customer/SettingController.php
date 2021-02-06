<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\Settings\PasswordUpdateRequest;
use App\Http\Requests\Api\Customer\Settings\ProfileUpdateRequest;
use App\Http\Requests\Api\Customer\Settings\UploadAvatarRequest;
use App\Http\Resources\Auth\CustomerLoginDTO;
use App\Services\FileService;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function uploadAvatar(UploadAvatarRequest $request)
    {
        return response()->json([
            "avatar" => FileService::upload($request->file('avatar'), $request->user(), "avatars", true)
        ], 200);
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $user = $request->user();
        if (Hash::check($request['old_password'], $user->password)) {
            $user->update([
                'password' => $request['new_password'],
            ]);
            return response()->json(new CustomerLoginDTO($user), 200);
        }
        return response()->json(['message' => __("Wrong Password")], 400);
    }

    public function updatePhone($request)
    {
        //
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->update($request->validated());

        return response()->json(new CustomerLoginDTO($user), 200);
    }
}
