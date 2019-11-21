<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id', 'id_project', 'name',
    ];

    function user(){
  		return $this->hasMany('App\member_of_board','id_board');
      }

    function project(){
        return $this->belongsTo('App\Project', 'id_project');
    }

    function card(){
        return $this->hasMany('App\Card', 'id_board');
    }
}
