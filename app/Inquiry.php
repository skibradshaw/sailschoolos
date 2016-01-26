<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    //
    protected $table = 'inquiry_profiles';
    protected $fillable = ['user_id','type','destination','boat_type','notes','interests','newsletter'];

    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
