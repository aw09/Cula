<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class member_of_project extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id_user', 'id_project'
  ];

  public function project()
  {
      return $this->belongsto('App\Project', 'id_project');
  }
  
  public function user()
  {
      return $this->belongsto('App\User', 'id_user');
  }
}
