<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class PartStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'en' => 'required|array',
            'en.name' => 'required|string|max:110',
            'en.description' => 'required|string|max:500',
            'ar' => 'required|array',
            'ar.name' => 'required|string|max:110',
            'ar.description' => 'required|string|max:500',

            'part_category_id' => 'required|numeric|exists:part_categories,id',
            'car_brand_id' => 'required|numeric|exists:car_brands,id',
            'car_brand_model_id' => 'required|numeric|exists:car_brand_models,id',
            'year' => 'required|numeric|min:1970|max:2200',
            'price' => 'required|numeric|min:0|max:99999999',
        ];
    }
}
