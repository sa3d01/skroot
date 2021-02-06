<?php

namespace App\Http\Requests\Api\Customer;

use App\Http\Requests\Api\ApiMasterRequest;

class CustomerAddressStoreRequest extends ApiMasterRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => 'required|string|max:190',
            "country_id" => 'required|numeric|exists:countries,id',
            "city_id" => 'required|numeric|exists:cities,id',
            "street" => 'required|string|max:190',
            "zip_code" => 'required|numeric',
            "phone" => 'required|string|max:50',
        ];
    }
}
