<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class CarBrandModelTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];
}
