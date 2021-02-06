<?php

namespace App\Http\Requests\Api\Help;

use App\Http\Requests\Api\ApiMasterRequest;

class ReportedProblemStoreRequest extends ApiMasterRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "problem_type_id" => 'required|numeric|exists:problem_types,id',
            "message" => 'required|string|max:400',
        ];
    }
}
