<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class member_of_project extends Model
{
    protected $fillable = [
        'id_user', 'id_project', 
    ];
}