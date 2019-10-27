<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Project;
use App\member_of_project;
use App\Http\Controllers\Controller;
use Validator;

class ProjectController extends Controller
{
    public $successStatus = 200;

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $input = $request->all();
        $project = Project::create($input);
        $success['name'] =  $project->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function update(Request $request, Project $project){
        $project->update($request->all());
        $success =  $project;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function destroy(Project $id){
        $project->delete();
        return response()->json(['success'=>'Success'], $this->successStatus);
    }

    public function addMember(Request $request){
        $validator = Validator::make($request->all(),[
            'id_user' => 'required',
            'id_project' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $input = $request->all();
        $memberBoard = member_of_project::create($input);

        return response()->json(['success'=>'success'], $this->successStatus);
    }




}
