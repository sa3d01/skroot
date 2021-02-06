<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\CarBrandModel;
use Illuminate\Http\Request;

class CarBrandModelController extends Controller
{
    public function jsonBrandModels(Request $request)
    {
        if ($request->has('brandId')) {
            return response()->json(CarBrandModel::where('car_brand_id', $request['brandId'])->get());
        }
        return response()->json(CarBrandModel::all());
    }
}
