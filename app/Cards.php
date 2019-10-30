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
}
