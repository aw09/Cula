<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class label extends Model
{
    protected $fillable = [
        'id', 'label', 'color_of_label',
    ];
}
