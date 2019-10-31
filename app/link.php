<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'id', 'id_task', 'link'
    ];

    function link(){
        return $this->belongTo('App\task', 'id_task');
      }
}
