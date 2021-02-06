<?php

namespace App\Http\Controllers\Api\General\Help;

use App\Http\Controllers\Controller;
use App\Http\Resources\General\ProblemTypeDTO;
use App\Models\ProblemType;

class ProblemTypeController extends Controller
{
    public function index()
    {
        return response()->json(ProblemTypeDTO::collection(ProblemType::all()), 200);
    }
}
