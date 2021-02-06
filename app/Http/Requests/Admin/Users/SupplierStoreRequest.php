<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'brand_ids' => 'required|array',
            'name' => 'required|string|max:110',
            'email' => 'required|email|max:90|unique:users',
            'phone' => 'required|string|max:90|unique:users',
            'password' => 'required|confirmed|string|min:6|max:15',
        ];
    }
}
