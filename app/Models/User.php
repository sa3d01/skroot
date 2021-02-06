<?php

namespace App\Models;

use App\Http\Enums\MediaCollectionNames;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    use HasApiTokens;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'phone',
        'phone_verified_at',
        'password',
        'menuroles',
        'country_id',
        'city_id',
        'bio',
        'avatar',
        //'birthday',
        //'gender',
        'banned',
        'locale',
        'device_uuid',
        'fcm_token',
        'notification_toggle',
        'os',
        'last_session_id',
        'last_login_at',
        'last_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $attributes = [
        'menuroles' => 'user',
    ];

    protected $appends = [
        'is_completed_profile',
        'avatar_url',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    protected function getIsCompletedProfileAttribute()
    {
        if ($this->phone) {
            return true;
        }
        return false;
    }

    protected function getAvatarUrlAttribute()
    {
        $file = $this->getMedia(MediaCollectionNames::UserAvatars)->first();
        if ($file) {
            return $file->getFullUrl();
        }
        return asset('assets/defaults/default-avatar.png');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function carBrands() //if user is supplier
    {
        return $this->belongsToMany(CarBrand::class, "car_brand_user");
    }

}
