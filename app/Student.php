<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\StudentScope;

class Student extends User
{
    //
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StudentScope);
    }
}
