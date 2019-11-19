<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'id', 'id_user', 'id_task', 'comment', 'date'
    ];

    function comment(){
        return $this->belongsTo('App\task', 'id_task');
      }
}
