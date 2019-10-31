<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'id', 'label', 'color_of_label',
    ];

    function label(){
        return $this->hasMany('App\task', 'id_label');
      }
}
