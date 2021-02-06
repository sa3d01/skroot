<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_en' => ['required', 'string', 'max:90', $this->localeUnique("country_translations", "name", $this->name_en, "en")],
            'name_ar' => ['required', 'string', 'max:90', $this->localeUnique("country_translations", "name", $this->name_ar, "ar")],
            'currency_en' => ['required', 'string', 'max:90', $this->localeUnique("country_translations", "currency", $this->currency_en, "en")],
            'currency_ar' => ['required', 'string', 'max:90', $this->localeUnique("country_translations", "currency", $this->currency_ar, "ar")],
        ];
    }

    private function localeUnique($table, $column, $value, $locale)
    {
        return Rule::unique($table, $column)->where(function ($query) use ($column, $value, $locale) {
            return $query->where($column, $value)->where("locale", $locale);
        });
    }
}
