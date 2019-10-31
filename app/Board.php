<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [
        'id', 'id_project', 'name', 
    ];
    function user(){
  		return $this->hasMany('App\member_of_board','id_board');
  	}
}
