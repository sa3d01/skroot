<?php

namespace App\Models;

use App\Http\Enums\MediaCollectionNames;
use App\Services\FileService;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class CarBrandModel extends Model implements TranslatableContract, HasMedia
{
    use SoftDeletes;
    use Translatable;
    use HasMediaTrait;

    public $translatedAttributes = [
        'name',
    ];
    protected $fillable = [
        'car_brand_id',
    ];
    protected $appends = [
        'image_url',
    ];

    protected function getImageUrlAttribute()
    {
        $file = $this->getMedia(MediaCollectionNames::CarBrandModels)->first();
        if ($file) {
            return FileService::getFileUrl($file);
        }
        return asset('assets/defaults/default-avatar.png');
    }

    public function carBrand()
    {
        return $this->hasMany(CarBrand::class);
    }

}
