<?php

namespace App\Http\Controllers\Api\General\Help;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Help\ReportedProblemStoreRequest;
use App\Models\ReportedProblem;

class ReportedProblemController extends Controller
{
    public function store(ReportedProblemStoreRequest $request)
    {
        $data = $request->validated();
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }
        ReportedProblem::create($data);
        return response()->json(null, 200);
    }
}
