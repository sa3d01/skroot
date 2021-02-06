<?php

namespace App\Http\Controllers\Api\Location;

use App\Http\Controllers\Controller;
use App\Http\Resources\Location\CitiesCollectionDTO;
use App\Models\City;

class CityController extends Controller
{
    public function index()
    {
        //return response()->json(new CitiesCollectionDTO(City::all()), 200);
        return new CitiesCollectionDTO(City::all());
    }
}
