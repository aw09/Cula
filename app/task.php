<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
  use SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id_role', 'id_card', 'task', 'detail_of_task', 'due_date',
      'start_date', 'finish_date', 'id_label', 'id_grouping'
  ];
  function user(){
		return $this->hasMany('App\member_of_task','id_task');
	}
  public function role()
  {
      return $this->belongsTo('App\User_Role', 'id_role');
  }

  function card(){
    return $this->belongsTo('App\Card', 'id_card');
  }

  function checkList(){
    return $this->hasMany('App\CheckList', 'id_task');
  }

  function comment(){
    return $this->hasMany('App\Comment', 'id_task');
  }

  function link(){
    return $this->hasMany('App\Link', 'id_task');
  }

  function label(){
    return $this->belongsTo('App\Label', 'id_label');
  }
}
