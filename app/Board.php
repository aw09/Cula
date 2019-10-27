<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [
        'id_board', 'id_project', 'name_board', 
    ];
}
