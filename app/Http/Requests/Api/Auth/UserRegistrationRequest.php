<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;
use App\Utils\MoPhone;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UserRegistrationRequest extends ApiMasterRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('phone')) {
//            $this->merge(['phone' => $this->phone]);
            $phone = new MoPhone($this->phone);
            if (!$phone->isValid()) {
                throw new HttpResponseException(response()->json([
                    'field' => 'phone',
                    'message' => $phone->errorMsg()
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)); // 422
            }
            $this->merge(['phone' => $phone->getNormalized()]);
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:110',
            'email' => 'required|email|max:90|unique:users',
            'phone' => 'required|string|max:90|unique:users',
            'password' => 'required|string|min:6|max:15',
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
        ];
    }
}
