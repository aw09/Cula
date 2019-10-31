<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
  protected $fillable = [
      'role'
  ];
  function task(){
    return $this->hasMany('App\Task','id_role');
  }
}
