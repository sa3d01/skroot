<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IntroSlidesCollectionDTO extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($q) {
            return [
                'id' => (int)$q->id,
                //'order' => (int)$q->order,
                'title_en' => $q->translate('en')->title,
                'title_ar' => $q->translate('ar')->title,
                'content_en' => $q->translate('en')->content,
                'content_ar' => $q->translate('ar')->content,
                "image_url" => $q->image_url,
            ];
        });
    }
}
