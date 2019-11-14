<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member_of_task extends Model
{
  protected $fillable = [
      'id_user', 'id_task'
  ];
  public function task()
  {
      return $this->hasone('App\Task', 'id_task');
  }
  public function user()
  {
      return $this->belongsTo('App\User', 'id_user');
  }
}
