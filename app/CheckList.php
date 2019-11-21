<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckList extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id','id_task','check_list','due_date',
    ];

    function checkList(){
        return $this->belongsTo('App\task', 'id_task');
    }
}
