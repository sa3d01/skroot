<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:110',
            'email' => "required|email|max:90|unique:users,email," . $this->customer->id,
            'phone' => "required|string|max:90|unique:users,phone," . $this->customer->id,
        ];
    }
}
