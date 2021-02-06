<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'display_name',
        'size',
        'logo',
    ];

    public function locations()
    {
        return $this->hasMany(CompanyLocation::class, 'company_location_id');
    }
}
