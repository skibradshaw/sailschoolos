<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ContactScope;

class Contact extends User
{
    //
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ContactScope);
    }
}
