<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    protected $fillable = [
        'id', 'name', 'id_board',
    ];
    function user(){
  		return $this->hasMany('App\member_of_card','id_card');
      }
      
    function board(){
        return $this->belongTo('App\Board', 'id_board');
    }

    function task(){
        return $this->hasMany('App\task', 'id_card');
    }

    function cluster(){
        return $this->hasMany('App\Clustering', 'id_card');
    }
}
