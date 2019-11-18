<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DateTime;
use App\member_of_task;
use App\Task;

class TaskController extends Controller
{
  public $successStatus = 200;
  public function store(Request $request)
  {
      $user = Auth::user();
      $validator = Validator::make($request->all(),[
          'id_card' => 'required',
          'task' => 'required',
      ]);

      if($validator->fails()){
          return response()->json(['error'=>$validator->errors()], 401);
      }
      $input = $request->all();
      $task = Task::create($input);
      $req['id_user'] = $user->id;
      $req['id_task'] = $task->id;

      $memberTask = member_of_task::create($req);
      $success =  $task->task;

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
        $user = Auth::user();
        $task->update($request->all());
        $success =  $task;
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
    $user = Auth::user();
      $task->delete();
      return response()->json(['success'=>'Success'], $this->successStatus);
  }

  public function addMember(Request $request){
      $user = Auth::user();
      $validator = Validator::make($request->all(),[
          'id_user' => 'required',
          'id_task' => 'required|unique:member_of_tasks,id_task,NULL,NULL,id_user,'.$user->id,
      ]);

      if($validator->fails()){
          return response()->json(['error'=>$validator->errors()], 401);
      }

      $input = $request->all();
      $memberTask = member_of_task::create($input);

      return response()->json(['success'=>'success'], $this->successStatus);
  }

  public function deleteMember(Request $request){
    $validator = Validator::make($request->all(),[
        'id_user' => 'required',
        'id_task' => 'required',
    ]);

    if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
    }

    member_of_board::where('id_user', $request['id_user'])
                                ->where('id_task', $request['id_task'])->delete();;

    return response()->json(['success'=>'Success'], $this->successStatus);
}

  public function getMember(Request $request){
    $user = Auth::user();
    $validator = Validator::make($request->all(),[
        'id_project' => 'required'
    ]);
    if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
    }
    $project = Project::find($request->id_project);
    if(isset($project)){
      $member = $project->user;
      return response()->json($member, $this->successStatus);
    }
    else
      return response()->json("Project not found", 401);
  }
  public function myTask(){
      $user = Auth::user();
      $listTask = array();
      $task = $user->task;
      foreach ($task as $key) {
        $key = $key->task;
        $key['id_board'] = intval($key->card->board->id);
        $key['id_project'] = intval($key->card->board->project->id);
        $listTask[] = $key;
      }
      return response()->json($listTask, $this->successStatus);
  }

  public function myUrgentTask(){
    $user = Auth::user();
    $dateAWeek = (new DateTime('+7 days'))->format('Y-m-d');
    // dd($dateAWeek);
    $listTask = array();
    $task = $user->task;
    foreach ($task as $key) {
      $listTask = Task::where('due_date','<',$dateAWeek)->get();
    }

    return response()->json($listTask, $this->successStatus);
  }
}
