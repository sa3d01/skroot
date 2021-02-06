<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class StaticPageDTO extends JsonResource
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
            'title' => [
                "en" => $this->translate('en')->title,
                "ar" => $this->translate('ar')->title,
            ],
            'content' => [
                "en" => $this->translate('en')->content,
                "ar" => $this->translate('ar')->content,
            ],
        ];
    }
}
