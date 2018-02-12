<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseTemplate extends Model
{
    //
    protected $fillable = ['name','trigger_event','user_type_id'];
    
    
    //Relationships
    public function details()
    {
        return $this->hasMany(\App\ResponseTemplateDetail::class);
    }

    public function type()
    {
        return $this->belongsTo(\App\UserType::class, 'user_type_id');
    }
}
