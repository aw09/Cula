<?php

namespace App\Http\Controllers\API;

use App\Grouping;
use App\task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class GroupingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $successStatus = 200;

    public function index()
    {
        $label = Grouping::all();
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
        $validator = Validator::make($request->all(),[
            'id_card' => 'required',
            'grouping' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);

        }

        $input = $request->all();
        $label = Grouping::create($input);
        $success =  $label;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grouping  $grouping
     * @return \Illuminate\Http\Response
     */
    public function show(Grouping $grouping)
    {
        return response()->json(['success'=>$grouping], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grouping  $grouping
     * @return \Illuminate\Http\Response
     */
    public function edit(Grouping $grouping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grouping  $grouping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grouping $grouping)
    {
        $validator = Validator::make($request->all(),[
            //'id_card' => 'required',
            'grouping' => 'required',
            
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
     * @param  \App\Grouping  $grouping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grouping $grouping)
    {
        $grouping->delete();
        return response()->json(['success'=>'Success'], $this->successStatus);
    }

    public function addTask(Request $request){
        $validator = Validator::make($request->all(),[
            'id_task' => 'required',
            'id_grouping' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $task = task::find($request->id_task);
        
        $task->id_grouping = $request->id_grouping;
        $task->save();
        return response()->json(['success'=>'Success'], $this->successStatus);

    }

    public function myTask(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'id_grouping' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $listTask=task::where('id_grouping', $request['id_grouping'])->get();
                                    
        return response()->json($listTask, $this->successStatus);
    }


}
