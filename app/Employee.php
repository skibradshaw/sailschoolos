<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\EmployeeScope;

class Employee extends User
{
    //
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new EmployeeScope);
    }
}
