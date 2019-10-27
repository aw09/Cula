<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function listTask(){
      if (Auth::check()) {
    error_log('User telah login');
}
else {
  error_log('user bellum login');
}
    }
}
