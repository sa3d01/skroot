<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Enums\ProductTypes;
use App\Http\Resources\General\StaticPageDTO;
use App\Http\Resources\Product\PartDTO;
use App\Models\Product;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $where['type'] = ProductTypes::PART;
        if ($request->has('car_brand_id')) {
            $where['car_brand_id'] = $request['car_brand_id'];
        }
        if ($request->has('car_brand_model_id')) {
            $where['car_brand_model_id'] = $request['car_brand_model_id'];
        }
        if ($request->has('part_category_id')) {
            $where['part_category_id'] = $request['part_category_id'];
        }
        if ($request->has('year')) {
            $where['year'] = $request['year'];
        }

        $products = Product::where($where)->paginate();
        return PartDTO::collection($products);
    }

    public function show(Product $part)
    {
        return response()->json(new PartDTO($part), 200);
    }

}
