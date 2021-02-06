<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class AccessoryDTO extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => (int)$this["id"],
            'name' => [
                "en" => $this->translate('en')->name,
                "ar" => $this->translate('ar')->name,
            ],
            'description' => [
                "en" => $this->translate('en')->description,
                "ar" => $this->translate('ar')->description,
            ],
            "car_brand" => [
                "id" => $this["carBrand"] ? $this["carBrand"]->id : 0,
                "name" => [
                    "en" => $this["carBrand"] ? $this["carBrand"]->translate('en')->name : "",
                    "ar" => $this["carBrand"] ? $this["carBrand"]->translate('ar')->name : "",
                ],
                "image_url" => $this["carBrand"] ? $this["carBrand"]->image_url : "",
            ],
            "car_brand_model" => [
                "id" => $this["carBrandModel"] ? $this["carBrandModel"]->id : 0,
                "name" => [
                    "en" => $this["carBrandModel"] ? $this["carBrandModel"]->translate('en')->name : "",
                    "ar" => $this["carBrandModel"] ? $this["carBrandModel"]->translate('ar')->name : "",
                ],
                "image_url" => $this["carBrandModel"] ? $this["carBrandModel"]->image_url : "",
            ],
            "part_category" => [
                "id" => $this["partCategory"] ? $this["partCategory"]->id : 0,
                "name" => [
                    "en" => $this["partCategory"] ? $this["partCategory"]->translate('en')->name : "",
                    "ar" => $this["partCategory"] ? $this["partCategory"]->translate('ar')->name : "",
                ],
                "image_url" => $this["partCategory"] ? $this["partCategory"]->image_url : "",
            ],
            "year" => (int)$this["year"],
            "price" => (double)$this["price"],
            "manufacturer" => "Dummy Manufacturer",
            "images_urls" => $this->images_urls,
        ];
    }
}
