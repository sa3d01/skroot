<?php

namespace App\Http\Resources\Cart;

use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Resources\Json\JsonResource;

class CartDTO extends JsonResource
{
    public function toArray($request)
    {

        $product=Product::find($this['product_id']);

        if(WishList::where(['user_id'=>\Auth::user()->id,'product_id'=>$product['id']])->first()){
            $is_wished=true;
        }else{
            $is_wished=false;
        }
        return [
            "id" => (int)$this["id"],
            'count'=>(int)$this['count'],
            "product_id" => (int)$product["id"],
            'name' => [
                "en" => $product->translate('en')->name,
                "ar" => $product->translate('ar')->name,
            ],
            'description' => [
                "en" => $product->translate('en')->description,
                "ar" => $product->translate('ar')->description,
            ],
            "car_brand" => [
                "id" => $product["carBrand"] ? $product["carBrand"]->id : 0,
                "name" => [
                    "en" => $product["carBrand"] ? $product["carBrand"]->translate('en')->name : "",
                    "ar" => $product["carBrand"] ? $product["carBrand"]->translate('ar')->name : "",
                ],
                "image_url" => $product["carBrand"] ? $product["carBrand"]->image_url : "",
            ],
            "car_brand_model" => [
                "id" => $product["carBrandModel"] ? $product["carBrandModel"]->id : 0,
                "name" => [
                    "en" => $product["carBrandModel"] ? $product["carBrandModel"]->translate('en')->name : "",
                    "ar" => $product["carBrandModel"] ? $product["carBrandModel"]->translate('ar')->name : "",
                ],
                "image_url" => $product["carBrandModel"] ? $product["carBrandModel"]->image_url : "",
            ],
            "part_category" => [
                "id" => $product["partCategory"] ? $product["partCategory"]->id : 0,
                "name" => [
                    "en" => $product["partCategory"] ? $product["partCategory"]->translate('en')->name : "",
                    "ar" => $product["partCategory"] ? $product["partCategory"]->translate('ar')->name : "",
                ],
                "image_url" => $product["partCategory"] ? $product["partCategory"]->image_url : "",
            ],
            "year" => (int)$product["year"],
            "price" => (double)$product["price"],
            "part_number" => $product["part_number"],
            "images_urls" => $product->images_urls,
            'is_wished'=>$is_wished,
        ];
    }
}
