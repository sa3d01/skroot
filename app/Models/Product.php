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

class Product extends Model implements TranslatableContract, HasMedia
{
    use SoftDeletes;
    use Translatable;
    use HasMediaTrait;

    public $translatedAttributes = [
        'name',
        'description',
    ];
    protected $fillable = [
        'type',
        'part_category_id',
        'car_brand_id',
        'car_brand_model_id',
        'year',
        'price',
        'part_number',
    ];
    protected $appends = [
        'images_urls',
    ];

    protected function getImagesUrlsAttribute()
    {
        $files = $this->getMedia(MediaCollectionNames::PartProductGallery);
        $imagesUrls = [];
        if ($files) {
            foreach ($files as $file) {
                array_push($imagesUrls, FileService::getFileUrl($file));
            }
        }
        return $imagesUrls;
    }

    public function partCategory()
    {
        return $this->belongsTo(PartCategory::class);
    }

    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class);
    }

    public function carBrandModel()
    {
        return $this->belongsTo(CarBrandModel::class);
    }

    public function wish()
    {
        return $this->hasMany(WishList::class);
    }
}
