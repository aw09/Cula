<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'id', 'id_user', 'notification',
    ];

    function notif(){
        return $this->belongsTo('App\Notification', 'id_user');
    }


}
