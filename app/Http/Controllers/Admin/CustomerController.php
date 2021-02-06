<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Enums\UserRole;
use App\Http\Requests\Admin\Users\CustomerStoreRequest;
use App\Http\Requests\Admin\Users\CustomerUpdateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\User;

class CustomerController extends Controller
{
    private $customerRoleName = "CUSTOMER";

    public function index()
    {
        return view('admin.customers.index')
            ->with('customers', User::role($this->customerRoleName)->orderBy('id', 'desc')->paginate())
            ->with('total', User::role($this->customerRoleName)->count());
    }

    public function create()
    {
        return view('admin.customers.create')
            ->with("countries", Country::all())
            ->with("cities", City::all());
    }

    public function store(CustomerStoreRequest $request)
    {
        $data = $request->validated();
        $data['banned'] = false;
        $data['locale'] = "en";
        $data['notification_toggle'] = true;

        $customer = User::create($data);
        $customer->assignRole(UserRole::of(UserRole::ROLE_CUSTOMER));

        return redirect()->route('admin.customers.index')
            ->with('title', __("Added successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function show(User $customer)
    {
        return redirect()->route('admin.customers.edit', $customer['id']);
    }

    public function edit(User $customer)
    {
        return view('admin.customers.edit')
            ->with('customer', $customer)
            ->with("countries", Country::all())
            ->with("cities", City::all());
    }

    public function update(CustomerUpdateRequest $request, User $customer)
    {
        $customer->update($request->validated());
        return redirect()->route('admin.customers.index')
            ->with('title', __("Updated successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }

    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')
            ->with('title', __("Deleted successfully"))
            ->with('message', "")
            ->with('class', 'alert-success');
    }
}
