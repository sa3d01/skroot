<?php

namespace App\Http\Requests\Api\Customer\Settings;

use App\Http\Requests\Api\ApiMasterRequest;

class UploadAvatarRequest extends ApiMasterRequest
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
            'avatar' => 'required|mimes:png,jpg,jpeg',
        ];
    }
}
