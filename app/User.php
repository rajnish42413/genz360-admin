<?php

namespace App;

use App\User\Data;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens , Notifiable;
    protected $guarded = ['id'];
    const BRAND = 'brand';
    const USER = 'user';
    const VERIFICATION_PENDING = 0;
    const VERIFICATION_DONE = 1;
 
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function scopeVerified(Builder $q)
    {
        return $q->where('status', static::VERIFICATION_DONE);
    }

    public function isVerificationPending()
    {
        return $this->status === static::VERIFICATION_PENDING;
    }
    // Getters
    public function getFirstNameAttribute()
    {
        return explode(' ', $this->name, 2)[0] ?? '';
    }

    public function getLastNameAttribute()
    {
        return explode(' ', $this->name, 2)[1] ?? '';
    }

  
    public function setData($data)
    {
        foreach ($data as $name => $value) {
            $exists = $this->data()->where(compact('name'))->first();
            if ($exists) {
                $this->data()->where(compact('name'))->update(compact('value'));
                continue;
            }
            $this->data()->save(new Data(compact('name', 'value')));
        }
    }

    public function getData($name)
    {
        return $this->data()->where('name', $name)->value('value');
    }

    public function removeData($name)
    {
        return $this->data()->where("name", $name)->delete();
    }

    public function data()
    {
        return $this->hasMany(Data::class);
    }

}
