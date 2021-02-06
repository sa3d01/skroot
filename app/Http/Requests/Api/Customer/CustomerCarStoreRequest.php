<?php

namespace App\Http\Requests\Api\Customer;

use App\Http\Requests\Api\ApiMasterRequest;

class CustomerCarStoreRequest extends ApiMasterRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "car_brand_id" => 'required|numeric|exists:car_brands,id',
            "car_brand_model_id" => 'required|numeric|exists:car_brand_models,id',
            "year" => 'required|numeric|min:1970|max:2100',
            'image' => 'required|mimes:png,jpg,jpeg',
        ];
    }
}
