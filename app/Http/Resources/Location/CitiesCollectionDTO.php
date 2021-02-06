<?php

namespace App\Http\Resources\Location;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CitiesCollectionDTO extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return Collection
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($q) {
            return [
                'id' => (int)$q->id,
                'country_id' => (int)$q->country_id,
                'name_en' => $q->translate('en')->name,
                'name_ar' => $q->translate('ar')->name,
            ];
        });
    }
}
