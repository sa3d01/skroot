<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Enums\MediaCollectionNames;
use App\Http\Requests\Api\Customer\CustomerCarStoreRequest;
use App\Http\Requests\Api\Customer\CustomerCarUpdateRequest;
use App\Http\Resources\Customer\CustomerCarDTO;
use App\Http\Resources\Product\PartDTO;
use App\Models\CustomerCar;
use App\Models\Product;
use App\Models\WishList;
use App\Services\FileService;

class WishListController extends Controller
{
    public function index()
    {
        $product_ids = WishList::where('user_id', auth()->user()->id)->pluck('product_id');
        $products = Product::whereIn('id', $product_ids)->paginate();
        return PartDTO::collection($products);
    }


    public function wishListModification($product_id):object{
        $is_favourite=WishList::where(['user_id'=>\request()->user()->id, 'product_id'=>$product_id])->first();
        if ($is_favourite){
            $is_favourite->delete();
        }else{
            WishList::create([
                'user_id'=>\request()->user()->id,
                'product_id'=>$product_id
            ]);
        }
        $product_ids = WishList::where('user_id', auth()->user()->id)->pluck('product_id');
        $products = Product::whereIn('id', $product_ids)->paginate();
        return PartDTO::collection($products);
    }

}
