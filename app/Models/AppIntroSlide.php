<?php

namespace App\Models;

use App\Services\FileService;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class AppIntroSlide extends Model implements TranslatableContract, HasMedia
{
    use SoftDeletes;
    use Translatable;
    use HasMediaTrait;

    public $translatedAttributes = [
        'title',
        'content',
    ];
    protected $fillable = [
        'order',
    ];
    protected $appends = [
        'image_url',
    ];

    protected function getImageUrlAttribute()
    {
        $file = $this->getMedia('images')->first();
        if ($file) {
            return FileService::getFileUrl($file);
        }
        return asset('assets/defaults/sobky.jpg');
    }
}
