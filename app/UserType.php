<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    //
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'user_user_types', 'user_id', 'user_type_id');
    }
}
