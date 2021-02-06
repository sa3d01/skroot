<?php

namespace App\Http\Requests\Api\Customer\Settings;

use App\Http\Requests\Api\ApiMasterRequest;

class ProfileUpdateRequest extends ApiMasterRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|max:120',
//            'phone' => "nullable|string|max:90|unique:users,phone," . $request->user()->id,
            'country_id' => 'nullable|numeric|exists:countries,id',
            'city_id' => 'nullable|numeric|exists:cities,id',
            'skills' => 'nullable|string|max:200',
            'gender' => 'nullable|string|in:MALE,FEMALE',
        ];
    }
}
