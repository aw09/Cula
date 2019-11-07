<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Project;
use Illuminate\Support\Facades\Auth;
use App\member_of_project;
use App\Http\Controllers\Controller;
use Validator;

class ProjectController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        $project = Project::all();
        return response()->json(['success'=>$project], $this->successStatus);
    }

    public function store(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $project = Project::create($input);
        $req['id_user'] = $user->id;
        $req['id_project'] = $project->id;
        $req = new Request($req);
        $this->addMember($req);

        $success['name'] =  $project->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function show(Project $project)
    {
        return response()->json(['success'=>$project], $this->successStatus);
    }

    public function update(Request $request, Project $project){
        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $project->update($request->all());
        $success =  $project;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function destroy(Project $project){
        $project->delete();
        return response()->json(['success'=>'Success'], $this->successStatus);
    }

    public function addMember(Request $request){
        $validator = Validator::make($request->all(),[
            'id_user' => 'required',
            'id_project' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $memberBoard = member_of_project::create($input);

        return response()->json(['success'=>'success'], $this->successStatus);
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
      $member = $project->user;

      return response()->json([$project->id=>$member], $this->successStatus);
    }
}
