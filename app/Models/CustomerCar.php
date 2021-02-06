<?php

namespace App\Models;

use App\Http\Enums\MediaCollectionNames;
use App\Services\FileService;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class CustomerCar extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        "customer_id",
        "car_brand_id",
        "car_brand_model_id",
        "year",
    ];
    protected $appends = [
        'image_url',
    ];

    protected function getImageUrlAttribute()
    {
        $file = $this->getMedia(MediaCollectionNames::CustomerCars)->first();
        if ($file) {
            return FileService::getFileUrl($file);
        }
        return asset('assets/defaults/default-avatar.png');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, "customer_id");
    }

    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class);
    }

    public function carBrandModel()
    {
        return $this->belongsTo(CarBrandModel::class);
    }
}
