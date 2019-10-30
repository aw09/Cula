<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'due_date',
    ];
    function user(){
  		return $this->hasMany('App\member_of_project','id_project');
  	}
}
