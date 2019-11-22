<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
  public function sendEmail()
  {
    try{
        Mail::send('email', ['nama' => "nama"], function ($message)
        {
            $message->subject("Judul");
            $message->from('donotreply@kiddy.com', 'Kiddy');
            $message->to("awagung9@gmail.com");
        });
        return response()->json("Success");
    }
    catch (Exception $e){
        return response()->json("Error", 401);
    }
  }
}
