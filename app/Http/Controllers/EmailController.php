<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
  public function sendEmail(Request $request)
  {
    try{
        Mail::send('email', ['nama' => $request->nama, 'pesan'=>$request->pesan], function ($message) use ($request)
        {
            $message->subject($request->judul);
            $message->from('noreply.cula@gmail.com', 'Cula Administrator');
            $message->to($request->email);
        });
        return TRUE;
    }
    catch (Exception $e){
        return FALSE;
    }
  }
}
