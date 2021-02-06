<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\CityStoreRequest;
use App\Http\Requests\Admin\Setting\CityUpdateRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Country $country)
    {
        return view('admin.settings.cities.index')
            ->with('country', $country)
            ->with('cities', City::where('country_id', $country->id)->orderBy('id', 'desc')->paginate())
            ->with('total', City::where('country_id', $country->id)->count());
    }

    public function jsonCities(Request $request)
    {
        if ($request->has('countryId')) {
            return response()->json(City::where('country_id', $request['countryId'])->get());
        }
        return response()->json(City::all());
    }

    public function create(Country $country)
    {
        return view('admin.settings.cities.create')
            ->with('country', $country);
    }

    public function store(CityStoreRequest $request, Country $country)
    {
        $data = $request->validated();
        $data['country_id'] = $country->id;
        $data['en'] = ['name' => $request->name_en];
        $data['ar'] = ['name' => $request->name_ar];
        City::create($data);
        return redirect()->route('admin.cities.index', ['country' => $country->id])
            ->with('title', __("Added successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function show(Country $country, City $city)
    {
        return redirect()->route('admin.cities.edit', ['country' => $country->id, 'city' => $city->id]);
    }

    public function edit(Country $country, City $city)
    {
        return view('admin.settings.cities.edit')
            ->with('country', $country)
            ->with('city', $city);
    }

    public function update(CityUpdateRequest $request, Country $country, City $city)
    {
        $data = $request->validated();
        $data['en'] = ['name' => $request->name_en];
        $data['ar'] = ['name' => $request->name_ar];

        $city->update($data);
        return redirect()->route('admin.cities.index', ['country' => $country->id])
            ->with('title', __("Updated successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function destroy(Country $country, City $city)
    {
        $city->delete();
        return redirect()->route('admin.cities.index', ['country' => $country->id])
            ->with('title', __("Deleted successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }
}
