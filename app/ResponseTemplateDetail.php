<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseTemplateDetail extends Model
{
    //
    

    //Relationships
    public function template()
    {
    	return $this->belongsTo('App\ResponseTemplate','response_template_id');
    }
}
