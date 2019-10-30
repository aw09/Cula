<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'ID_ROLE', 'ID_CARD', 'NAME_TASK', 'DETAIL_OF_TASK', 'DUE_DATE_TASK',
      'START_DATE_TASK', 'FINISH_DATE_TASK'
  ];
}
