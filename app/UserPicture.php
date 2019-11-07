<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPicture extends Model
{
    protected $fillable = [
        'id', 'id_user', 'picture',
    ];

    function notif(){
        return $this->belongTo('App\UserPicture', 'id_user');
    }
}
