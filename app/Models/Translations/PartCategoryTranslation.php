<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class PartCategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];
}
