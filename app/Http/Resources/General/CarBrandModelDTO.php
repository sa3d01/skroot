<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class CarBrandModelDTO extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'name' => [
                "en" => $this->translate('en')->name,
                "ar" => $this->translate('ar')->name,
            ],
            "image_url" => $this->image_url,
        ];
    }
}
