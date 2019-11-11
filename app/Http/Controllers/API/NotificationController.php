<?php

namespace App\Http\Controllers\API;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $successStatus = 200;
    public function index()
    {
        $notification = Notification::all();
        return response()->json(['success'=>$link], $this->successStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_user' => 'required',
            'notification' => 'requires',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $input = $request->all();
        $notification = Notification::create($input);

        return response()->json(['success'=>$notification], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        return response()->json(['success'=>$notification], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        $validator = Validator::make($request->all(),[
            'id_user' => 'required',
            'notification' => 'requires',
            'id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $notification->update($request->all());
        return response()->json(['success'=>$notification], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json(['success'=>'Success'], $this->successStatus);
    }
}
