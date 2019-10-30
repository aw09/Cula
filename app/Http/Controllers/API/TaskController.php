<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Task;

class TaskController extends Controller
{
  public $successStatus = 200;
  public function store(Request $request)
  {
      $validator = Validator::make($request->all(),[
          'id_card' => 'required',
          'name_task' => 'required',
      ]);

      if($validator->fails()){
          return response()->json(['error'=>$validator->errors()], 401);
      }

      $input = $request->all();
      $task = Task::create($input);
      $success['name_task'] =  $task->NAME_TASK;

      return response()->json(['success'=>$success], $this->successStatus);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function show(Task $task)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function edit(Task $task)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Task $task)
  {
      $task->update($request->all());
      $success =  task;
      return response()->json(['success'=>$success], $this->successStatus);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function destroy(Task $task)
  {
      $task->delete();
      return response()->json(['success'=>'Success'], $this->successStatus);
  }

  public function addMember(Request $request){
      $validator = Validator::make($request->all(),[
          'id_user' => 'required',
          'id_task' => 'required',
      ]);

      if($validator->fails()){
          return response()->json(['error'=>$validator->errors()], 401);
      }

      $input = $request->all();
      $memberTask = member_of_task::create($input);

      return response()->json(['success'=>'success'], $this->successStatus);
  }
}
