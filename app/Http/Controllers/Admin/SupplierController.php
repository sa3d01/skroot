<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Enums\UserRole;
use App\Http\Requests\Admin\Users\SupplierStoreRequest;
use App\Http\Requests\Admin\Users\SupplierUpdateRequest;
use App\Models\CarBrand;
use App\Models\City;
use App\Models\Country;
use App\Models\User;

class SupplierController extends Controller
{
    private $supplierRoleName;

    public function __construct()
    {
        $this->supplierRoleName = UserRole::of(UserRole::ROLE_SUPPLIER);
    }

    public function index()
    {
        return view('admin.suppliers.index')
            ->with('suppliers', User::role($this->supplierRoleName)->orderBy('id', 'desc')->paginate())
            ->with('total', User::role($this->supplierRoleName)->count());
    }

    public function create()
    {
        return view('admin.suppliers.create')
            ->with("brands", CarBrand::all())
            ->with("countries", Country::all())
            ->with("cities", City::all());
    }

    public function store(SupplierStoreRequest $request)
    {
        $data = $request->validated();
        $data['banned'] = false;
        $data['locale'] = "en";

        $supplier = User::create($data);
        $supplier->assignRole(UserRole::of(UserRole::ROLE_SUPPLIER));
        $supplier->carBrands()->sync($request["brand_ids"]);

        return redirect()->route('admin.suppliers.index')
            ->with('title', __("Added successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function show(User $supplier)
    {
        return redirect()->route('admin.suppliers.edit', $supplier['id']);
    }

    public function edit(User $supplier)
    {
        return view('admin.suppliers.edit')
            ->with('supplier', $supplier)
            ->with("old_selected_brands", $supplier->carBrands)
            ->with("brands", CarBrand::all())
            ->with("countries", Country::all())
            ->with("cities", City::all());
    }

    public function update(SupplierUpdateRequest $request, User $supplier)
    {
        $supplier->update($request->validated());
        $supplier->carBrands()->sync($request["brand_ids"]);
        return redirect()->route('admin.suppliers.index')
            ->with('title', __("Updated successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function destroy(User $supplier)
    {
        $supplier->delete();
        return redirect()->route('admin.suppliers.index')
            ->with('title', __("Deleted successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }
}
