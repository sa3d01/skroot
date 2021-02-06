<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = [
        'name',
    ];
    protected $fillable = [
        'country_id',
        'delivery_fee'
    ];

    public function county()
    {
        return $this->belongsTo(Country::class);
    }
}
