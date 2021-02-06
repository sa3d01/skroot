<?php

namespace App\Http\Controllers\Api\Location;

use App\Http\Controllers\Controller;
use App\Http\Resources\Location\CitiesCollectionDTO;
use App\Models\City;
use App\Models\Country;

class CountryCityController extends Controller
{
    public function index($countryId)
    {
        $country = Country::where('id', $countryId)->first();
        if (!$country) {
            return response()->json(['message' => "Country not found"], 400);
        }
//        return response()->json(
//            new CitiesCollectionDTO(City::where([
//                'country_id' => $countryId,])->get()), 200
//        );
        return new CitiesCollectionDTO(City::where(['country_id' => $countryId,])->get());
    }
}
