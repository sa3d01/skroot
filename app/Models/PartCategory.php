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

class PartCategory extends Model implements TranslatableContract, HasMedia
{
    use SoftDeletes;
    use Translatable;
    use HasMediaTrait;

    public $translatedAttributes = [
        'name',
    ];
    protected $fillable = [];
    protected $appends = [
        'image_url',
    ];

    protected function getImageUrlAttribute()
    {
        $file = $this->getMedia(MediaCollectionNames::PartCategories)->first();
        if ($file) {
            return FileService::getFileUrl($file);
        }
        return asset('assets/defaults/default-avatar.png');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
