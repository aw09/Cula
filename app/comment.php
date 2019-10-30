<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
      'id_user', 'id_task', 'comment'
  ];
  function user(){
		return $this->belongsto('App\User','id_user');
	}

}
