<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DateTime;
use App\member_of_task;
use App\Task;
use App\User;

class TaskController extends Controller
{
  public $successStatus = 200;

  public function index(Request $request)
    {
        $user = Auth::user();
        $task = Task::all();
        return response()->json($task, $this->successStatus);
    }

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
      $success['name'] =  $task->task;

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
    $listComplete = array();
      //$listCard=$task->checklist;
      foreach ($task as $key) {
        $key['task'] = $key->checkList;
        $listComplete[] = $key;
      }
      if($listCard == NULL){
          $error='Project not found';
          return response()->json($error, 404);
      } else {
          return response()->json($listComplete, $this->successStatus);
      }
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
    $nameTask = $task->name;
    $task->delete();
    return response()->json("Task '".$nameTask."' deleted", $this->successStatus);
  }

  public function addMember(Request $request){
    $user = Auth::user();
    $validator = Validator::make($request->all(),[
        'id_user' => 'required|unique_with:member_of_tasks, id_task',
        'id_task' => 'required',
    ]);

    if($validator->fails()){
        return response()->json([$validator->errors()], 401);
    }
    $nameUser = User::find($request->id_user)->name;
    $nameTask = Task::find($request->id_task)->name;
    $input = $request->all();
    $memberTask = member_of_task::create($input);

    return response()->json(["User '".$nameUser."' added to Task '".$nameTask."'"], $this->successStatus);

  }

  public function deleteMember(Request $request){
    $validator = Validator::make($request->all(),[
        'id_user' => 'required',
        'id_task' => 'required',
    ]);
    $nameUser = User::find($request->id_user)->name;
    $nameTask = Task::find($request->id_task)->name;
    if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
    }

    member_of_task::where('id_user', $request['id_user'])
                                ->where('id_task', $request['id_task'])->delete();



    return response()->json("User '".$nameUser."' deleted from Task '".$nameTask."'", $this->successStatus);

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
        $val = $key->task;
          if(isset($val))
          if(isset($val->card))
            if(isset($val->card->board))
              if(isset($val->card->board->project))
                $listTask[] = $val;
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
    foreach ($listTask as $key) {
      $key->card->board;
      $task[] = $key;
    }

    return response()->json($listTask, $this->successStatus);
  }
}
