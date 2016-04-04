<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $fillable = ['user_id','create_user_id','note_type','note', 'title','note_date'];
    protected $dates = ['note_date'];

    public function creator()
    {
        return $this->belongsTo('App\User', 'create_user_id');
    }

    public function getBadgeAttribute()
    {
        $return = '';
        switch ($this->note_type) {
            case "Email":
                $return = 'info';
                break;
            case "Phone":
                $return = 'warning';
                break;
            case "In-Person":
                $return = 'danger';
                break;
            case "Inquiry":
                $return = 'success';
                break;
            case "General":
                $return = 'primary';
                break;
            case "Scheduled Response":
                $return = 'default';
                break;
            default:
                $return = '';
        }
        return $return;
    }

    public function getIconAttribute()
    {
        $return = '<i class="fa fa-check"></i>';
        switch ($this->note_type) {
            case "Email":
                $return = '<i class="fa fa-envelope"></i>';
                break;
            case "Phone":
                $return = '<i class="fa fa-phone"></i>';
                break;
            case "In-Person":
                $return = '<i class="fa fa-user"></i>';
                break;
            case "Inquiry":
                $return = '<i class="fa fa-question"></i>';
                break;
            case "General":
                $return = '<i class="fa fa-file-text"></i>';
                break;
            case "Scheduled Response":
                $return = '<i class="fa fa-calendar"></i>';
                break;
            default:
                $return = '<i class="fa fa-check"></i>';
        }
        return $return;
    }
}
