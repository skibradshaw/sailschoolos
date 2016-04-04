<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CharterGuestScope;

class CharterGuest extends User
{
    //
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CharterGuestScope);
    }
}
