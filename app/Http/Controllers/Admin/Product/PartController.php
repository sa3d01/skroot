<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Enums\ProductTypes;
use App\Http\Requests\Admin\Product\PartStoreRequest;
use App\Http\Requests\Admin\Product\PartUpdateRequest;
use App\Imports\ProductsImport;
use App\Models\CarBrand;
use App\Models\CarBrandModel;
use App\Models\City;
use App\Models\Country;
use App\Models\PartCategory;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;

class PartController extends Controller
{
    public function index()
    {
        return view('admin.parts.index')
            ->with('parts', Product::where("type", ProductTypes::PART)->orderBy('id', 'desc')->paginate())
            ->with('total', Product::where("type", ProductTypes::PART)->count());
    }

    public function create()
    {
        $brands = CarBrand::all();
        if ($brands->count() > 0) {
            $brandModels = CarBrandModel::where("car_brand_id", $brands->first()->id)->get();
        } else {
            $brandModels = [];
        }

        return view('admin.parts.create')
            ->with("countries", Country::all())
            ->with("cities", City::all())
            ->with("categories", PartCategory::all())
            ->with("brands", $brands)
            ->with("models", $brandModels);
    }

    public function store(PartStoreRequest $request)
    {
        $data = $request->validated();
        $data["type"] = ProductTypes::PART;
        Product::create($data);

        return redirect()->route('admin.parts.index')
            ->with('title', __("Added successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function import()
    {

        $path=public_path("products_data.xlsx");
//return $path;
        Excel::import(new ProductsImport, $path);
    }

    public function show(Product $part)
    {
        return redirect()->route('admin.parts.edit', $part['id']);
    }

    public function edit(Product $part)
    {
        return view('admin.parts.edit')
            ->with('part', $part)
            ->with("countries", Country::all())
            ->with("cities", City::all())
            ->with("categories", PartCategory::all())
            ->with("brands", CarBrand::all())
            ->with("models", CarBrandModel::where("car_brand_id", $part->car_brand_id)->get());
    }

    public function update(PartUpdateRequest $request, Product $part)
    {
        $part->update($request->validated());
        return redirect()->route('admin.parts.index')
            ->with('title', __("Updated successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function destroy(Product $part)
    {
        $part->delete();
        return redirect()->route('admin.parts.index')
            ->with('title', __("Deleted successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }
}
