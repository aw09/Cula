<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{
    protected $fillable = [
        'id','id_task','check_list','due_date',
    ];

    function checkList(){
        return $this->belongsTo('App\task', 'id_task');
    }
}
