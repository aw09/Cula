<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPicture extends Model
{
    protected $fillable = [
        'id_user', 'picture',
    ];

    function profilePicture(){
        return $this->belongTo('App\User', 'id_user');
    }
}
