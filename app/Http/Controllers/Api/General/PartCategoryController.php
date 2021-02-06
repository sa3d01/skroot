<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\General\PartCategoryDTO;
use App\Models\PartCategory;

class PartCategoryController extends Controller
{
    public function index()
    {
        return PartCategoryDTO::collection(PartCategory::paginate());
    }
}
