<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAddressDTO extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "customer_id" => $this->customer_id,
            "title" => $this->title,
            "country" => [
                "id" => $this->country ? (int)$this->country->id : 0,
                'name' => [
                    "en" => $this->country ? $this->country->translate('en')->name : "",
                    "ar" => $this->country ? $this->country->translate('ar')->name : "",
                ],
            ],
            "city" => [
                "id" => $this->city ? (int)$this->city->id : 0,
                "country_id" => $this->city ? $this->city->country_id : "",
                'name' => [
                    "en" => $this->city ? $this->city->translate('en')->name : "",
                    "ar" => $this->city ? $this->city->translate('ar')->name : "",
                ],
            ],
            "street" => $this->street,
            "zip_code" => (int)$this->zip_code,
            "phone" => $this->phone,
        ];
    }
}
