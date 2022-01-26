<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, HasLocalePreference
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
    ];

    //for api
    protected $appends = [
        'photo_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'notification_options' => 'json',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'user_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id')->withDefault();
    }

//    accessor
    public function getPhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }
        return 'https://ui-avatars.com/api/?name=' . $this->name;
    }

    /*اذا كان حقل الاميمل اسمه بختلف*/
    public function routeNotificationForMail($notification = null)
    {
        return $this->email;
    }

//localize notification
    public function preferredLocale()
    {
        return $this->language;
    }

    /*اذا كان حقل الجوال اسمه بختلف*/
    public function routeNotificationForNexmo($notification = null)
    {
        return $this->mobile;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasAbility($abilities)
    {
        foreach ($this->roles as $role) {
            if (in_array($abilities, $role->abilities)) {
                return true;
            }
        }
        return false;
    }
}
