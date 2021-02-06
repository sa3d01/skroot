<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProblemType extends Model
{
    protected $fillable = [
        "label_en",
        "label_ar",
    ];
}
