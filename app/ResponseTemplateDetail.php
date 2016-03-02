<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseTemplateDetail extends Model
{
    //
    protected $fillable = ['number_of_days','template'];
    

    //Relationships
    public function template()
    {
    	return $this->belongsTo('App\ResponseTemplate','response_template_id');
    }
}
