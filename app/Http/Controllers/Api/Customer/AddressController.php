<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\CustomerAddressStoreRequest;
use App\Http\Requests\Api\Customer\CustomerAddressUpdateRequest;
use App\Http\Resources\Customer\CustomerAddressDTO;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $customer = $request->user();
        $addresses = CustomerAddress::where('customer_id', $customer->id)->paginate();
        return CustomerAddressDTO::collection($addresses);
    }

    public function show(CustomerAddress $address)
    {
        if ($address->customer_id == auth()->id()) {
            return response()->json(new CustomerAddressDTO($address), 200);
        }
        return response()->json(['code' => 'NotOwnItem', 'message' => 'You do not own this item'], 403);
    }

    public function store(CustomerAddressStoreRequest $request)
    {
        $data = $request->validated();
        $data['customer_id'] = auth()->id();
        $address = CustomerAddress::create($data);
        return response()->json(['id' => $address->id], 200);
    }

    public function update(CustomerAddressUpdateRequest $request, CustomerAddress $address)
    {
        if ($address->customer_id == $request->user()->id) {
            $address->update($request->validated());
            return response()->json(['id' => $address->id], 200);
        }
        return response()->json(['code' => 'NotOwnItem', 'message' => 'You do not own this item'], 403);
    }

    public function destroy(Request $request, CustomerAddress $address)
    {
        if ($address->customer_id == $request->user()->id) {
            $address->delete();
            return response()->json(null, 200);
        }
        return response()->json(['code' => 'NotOwnItem', 'message' => 'You do not own this item'], 403);
    }
}
