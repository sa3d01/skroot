<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportedProblem extends Model
{
    protected $fillable = [
        "problem_type_id",
        "user_id",
        "message",
    ];
}
