<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        "customer_id",
        "title",
        "country_id",
        "city_id",
        "street",
        "zip_code",
        "phone",
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, "customer_id");
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
