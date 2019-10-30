<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = [
        'id', 'id_user', 'id_task', 'comment', 'date'
    ];
}
