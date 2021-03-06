<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Notifiable;
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname','phone','city','state','country', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucfirst(strtolower($value));
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucfirst(strtolower($value));
    }
    public function getPhoneAttribute($value)
    {
        return "(".substr($value, 0, 3).") ".substr($value, 3, 3)."-".substr($value, 6);
    }
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/[^0-9]/i', '', trim($value));
    }

    public function getTypesListAttribute()
    {
        return $this->types->pluck('id')->toArray();
    }

    public function types()
    {
        return $this->belongsToMany(\App\UserType::class, 'user_user_types', 'user_id', 'user_type_id');
    }

    public function notes()
    {
        return $this->hasMany(\App\Note::class, 'user_id')->orderBy('note_date', 'desc');
    }
}
