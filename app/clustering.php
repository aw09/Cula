<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clustering extends Model
{
    function clustering(){
        return $this->belongsTo('App\Clustering','id_cluster');
    }

    function card(){
        return $this->belongsTo('App\Card','id_card');
    }
}
