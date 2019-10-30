<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class member_of_board extends Model
{
  protected $fillable = [
      'id_user', 'id_board'
  ];
  public function board()
  {
      return $this->belongsto('App\Board', 'id_board');
  }
  function user(){
		return $this->belongsto('App\User','id_user');
	}
}
