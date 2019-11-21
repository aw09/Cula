<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'id_board',
    ];
    function user(){
  		return $this->hasMany('App\member_of_card','id_card');
      }

    function board(){
        return $this->belongsTo('App\Board', 'id_board');
    }

    function task(){
        return $this->hasMany('App\Task', 'id_card');
    }


    function grouping(){
        return $this->hasMany('App\Cards', 'id_card');
    }

}
