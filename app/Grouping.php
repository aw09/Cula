<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grouping extends Model
{
    protected $fillable = [
        'grouping', 'id_card',
    ];

    function task(){
        return $this->hasMany('App\task', 'id_grouping');
      }

      function grouping(){
        return $this->belongsTo('App\Card', 'id_card');
      }


}
