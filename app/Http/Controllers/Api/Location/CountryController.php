<?php

namespace App\Http\Controllers\Api\Location;

use App\Http\Controllers\Controller;
use App\Http\Resources\Location\CountriesCollectionDTO;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        //return response()->json(new CountriesCollectionDTO(Country::all()), 200);
        return new CountriesCollectionDTO(Country::all());
    }
}
