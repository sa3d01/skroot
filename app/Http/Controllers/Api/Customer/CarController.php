<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Enums\MediaCollectionNames;
use App\Http\Requests\Api\Customer\CustomerCarStoreRequest;
use App\Http\Requests\Api\Customer\CustomerCarUpdateRequest;
use App\Http\Resources\Customer\CustomerCarDTO;
use App\Models\CustomerCar;
use App\Services\FileService;

class CarController extends Controller
{
    public function index()
    {
        $customer = auth()->user();
        $cars = CustomerCar::where('customer_id', $customer->id)->paginate();
        return CustomerCarDTO::collection($cars);
    }

    public function show(CustomerCar $car)
    {
        if ($car->customer_id == auth()->id()) {
            return response()->json(new CustomerCarDTO($car), 200);
        }
        return response()->json(['code' => 'NotOwnItem', 'message' => 'You do not own this item'], 403);
    }

    public function store(CustomerCarStoreRequest $request)
    {
        $data = $request->validated();
        $data['customer_id'] = auth()->id();
        $car = CustomerCar::create($data);
        FileService::upload($request->file('image'), $car, MediaCollectionNames::CustomerCars, true);
        return response()->json(['id' => $car->id], 200);
    }

    public function update(CustomerCarUpdateRequest $request, CustomerCar $car)
    {
        if ($car->customer_id == $request->user()->id) {
            $data = $request->validated();
            $car->update($data);
            if (array_key_exists("image", $data)) {
                FileService::upload($request->file('image'), $car, MediaCollectionNames::CustomerCars, true);
            }
            return response()->json(['id' => $car->id], 200);
        }
        return response()->json(['code' => 'NotOwnItem', 'message' => 'You do not own this item'], 403);
    }

    public function destroy(CustomerCar $car)
    {
        if ($car->customer_id == auth()->id()) {
            $car->delete();
            return response()->json(null, 200);
        }
        return response()->json(['code' => 'NotOwnItem', 'message' => 'You do not own this item'], 403);
    }
}
