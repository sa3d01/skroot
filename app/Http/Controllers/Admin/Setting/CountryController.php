<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\CountryStoreRequest;
use App\Http\Requests\Admin\Setting\CountryUpdateRequest;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        return view('admin.settings.countries.index')
            ->with('countries', Country::orderBy('id', 'desc')->paginate())
            ->with('total', Country::count());
    }

    public function create()
    {
        return view('admin.settings.countries.create');
    }

    public function store(CountryStoreRequest $request)
    {
        Country::create([
            'en' => ['name' => $request->name_en, "currency" => $request->currency_en],
            'ar' => ['name' => $request->name_ar, "currency" => $request->currency_ar],
        ]);

        return redirect()->route('admin.countries.index')
            ->with('title', __("Added successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function show(Country $country)
    {
        return redirect()->route('admin.countries.edit', $country['id']);
    }

    public function edit(Country $country)
    {
        return view('admin.settings.countries.edit')
            ->with('country', $country);
    }

    public function update(CountryUpdateRequest $request, Country $country)
    {
        $country->update([
            'en' => ['name' => $request->name_en, "currency" => $request->currency_en],
            'ar' => ['name' => $request->name_ar, "currency" => $request->currency_ar],
        ]);
        return redirect()->route('admin.countries.index')
            ->with('title', __("Updated successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('admin.countries.index')
            ->with('title', __("Deleted successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }
}
