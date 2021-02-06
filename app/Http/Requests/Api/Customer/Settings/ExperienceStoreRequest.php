<?php

namespace App\Http\Requests\Api\Customer\Settings;

use App\Http\Requests\Api\ApiMasterRequest;

class ExperienceStoreRequest extends ApiMasterRequest
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
            'company' => "required|string|max:90",
            'job_title' => "required|string|max:120",
            'from_date' => "nullable|string|max:30",
            'to_date' => "nullable|string|max:30",
            'currently' => "required|boolean",
        ];
    }
}
