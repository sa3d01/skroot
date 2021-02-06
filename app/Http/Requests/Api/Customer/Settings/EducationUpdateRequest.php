<?php

namespace App\Http\Requests\Api\Customer\Settings;

use App\Http\Requests\Api\ApiMasterRequest;

class EducationUpdateRequest extends ApiMasterRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "university" => "required|string|max:120",
            "field" => "required|string|max:90",
            "graduation" => "required|string|max:90",
            "grade" => "required|string|max:90"
        ];
    }
}
