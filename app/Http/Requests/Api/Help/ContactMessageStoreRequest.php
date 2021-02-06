<?php

namespace App\Http\Requests\Api\Help;

use App\Http\Requests\Api\ApiMasterRequest;

class ContactMessageStoreRequest extends ApiMasterRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => 'required|string|max:190',
            "email" => 'required|email|max:190',
            "phone" => 'required|string|max:190',
            "message" => 'required|string|max:400',
        ];
    }
}
