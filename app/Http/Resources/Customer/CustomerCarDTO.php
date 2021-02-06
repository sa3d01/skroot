<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\General\CarBrandDTO;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerCarDTO extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "customer_id" => $this->customer_id,
            "car_brand" => new CarBrandDTO($this->carBrand),
            "car_brand_model" => [
                "id" => $this->carBrandModel->id,
                "car_brand_id" => $this->carBrandModel->car_brand_id,
                'name' => [
                    "en" => $this->carBrandModel->translate('en')->name,
                    "ar" => $this->carBrandModel->translate('ar')->name,
                ],
            ],
            "year" => (int)$this->year,
            "image_url" => $this->image_url,
        ];
    }
}
