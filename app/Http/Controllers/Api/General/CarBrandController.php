<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\General\CarBrandDTO;
use App\Http\Resources\General\CarBrandModelDTO;
use App\Models\CarBrand;
use App\Models\CarBrandModel;

class CarBrandController extends Controller
{
    public function index()
    {
        return CarBrandDTO::collection(CarBrand::paginate());
    }

    public function fetchModels(CarBrand $carBrand)
    {
        return CarBrandModelDTO::collection(CarBrandModel::where("car_brand_id", $carBrand->id)->paginate());
    }
}
