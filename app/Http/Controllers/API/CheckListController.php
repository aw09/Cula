<?php

namespace App\Http\Controllers\API;

use App\CheckList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CheckListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $successStatus = 200;
    public function index()
    {
        $listChecklist=CheckList::all();

        return response()->json($listChecklist, $this->successStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'id_task' => 'required',
            'check_list' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);

        }

        $input = $request->all();
        $checkList = CheckList::create($input);
        $success['name'] =  $checkList->check_list;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function show(CheckList $checklist)
    {
        return response()->json($checkList, $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckList $checklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckList $checklist)
    {

        $validator = Validator::make($request->all(),[
            'check_list' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);

        }

        $checklist->update($request->all());
        return response()->json($checklist, $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckList $checkList)
    {
        $nameBoard = $checkList->checklist;
        $checkList->delete();
        return response()->json("Check list '".$nameBoard."' deleted", $this->successStatus);
    }

    public function listOfChecklist(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_task' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $listChecklist=CheckList::where('id_task', $request['id_task'])->get();

        return response()->json($listChecklist, $this->successStatus);
    }
}
