<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class member_of_card extends Model
{
  protected $fillable = [
      'id_user', 'id_card'
  ];
  public function card()
  {
      return $this->belongsto('App\Card', 'id_card');
  }

  function user(){
		return $this->belongsto('App\User','id_user');
	}
}
