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
      'ID_USER', 'ID_PROJECT'
  ];

  public function project()
  {
      return $this->belongsto('App\Project');
  }
  // public function user()
  // {
  //     return $this->belongsto('App\User');
  // }
}
