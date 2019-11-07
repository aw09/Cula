<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'id', 'id_user', 'notification', 'date'
    ];

    function notif(){
        return $this->belongTo('App\Notification', 'id_user');
    }


}
