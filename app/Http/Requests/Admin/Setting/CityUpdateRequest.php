<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_en' => ['required', 'string', 'max:90', $this->localeUnique("city_translations", "name", $this->name_en, "en")],
            'name_ar' => ['required', 'string', 'max:90', $this->localeUnique("city_translations", "name", $this->name_ar, "ar")],
            'delivery_fee' => 'required|numeric|min:0|max:5000',
        ];
    }

    private function localeUnique($table, $column, $value, $locale)
    {
        $ignoreId = $this->city->translate($locale)->id;
        return Rule::unique($table, $column)->where(function ($query) use ($column, $value, $locale) {
            return $query->where($column, $value)->where("locale", $locale);
        })->ignore($ignoreId);
    }
}
