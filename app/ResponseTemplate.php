<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseTemplate extends Model
{
    //
    
    //Relationships
    public function details()
    {
    	return $this->hasMany('App\ResponseTemplateDetail');
    }

    public function type()
    {
    	return $this->belongsTo('App\UserType','user_type_id');
    }
}
