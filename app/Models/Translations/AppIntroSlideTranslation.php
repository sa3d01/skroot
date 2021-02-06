<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class AppIntroSlideTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'content',
    ];
}
