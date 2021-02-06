<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class ProblemTypeDTO extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => (int)$this->id,
            'label' => [
                "en" => $this->label_en,
                "ar" => $this->label_ar,
            ],
        ];
    }
}
