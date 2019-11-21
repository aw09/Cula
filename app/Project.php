<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'due_date',
    ];

    function user(){
  		return $this->hasMany('App\member_of_project','id_project');
      }

    function board(){
        return $this->hasMany('App\Board','id_project');
    }
}
