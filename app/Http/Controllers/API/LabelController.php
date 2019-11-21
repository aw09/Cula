<?php

namespace App\Http\Controllers\API;

use App\Label;
use App\task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $successStatus = 200;
    public function index()
    {
        $user = Auth::user();
        $label = Label::all();
        return response()->json(['success'=>$label], $this->successStatus);
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
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'label' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);

        }

        $input = $request->all();
        $label = Label::create($input);
        $success =  $label;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($label)
    {
        $user = Auth::user();
        return response()->json(['success'=>$label], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Label $label)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'label' => 'required',

        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $label->update($request->all());
        $success =  $label;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        $user = Auth::user();
        $label->delete();
        return response()->json(['success'=>'Success'], $this->successStatus);
    }

    public function addTask(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'id_task' => 'required',
            'id_label' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $task = task::find($request->id_task);
        
        $task->id_label = $request->id_label;
        $task->save();
        return response()->json(['success'=>'Success'], $this->successStatus);

    }

    public function removeTask(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'id_task' => 'required',
            //'id_label' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $task = task::find($request->id_task);
        
        $task->id_label = NULL;
        $task->save();
        return response()->json(['success'=>'Success'], $this->successStatus);

    }
}
