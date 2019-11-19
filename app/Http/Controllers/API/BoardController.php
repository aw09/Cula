<?php

namespace App\Http\Controllers\API;

use App\Board;
use App\member_of_board;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class BoardController extends Controller
{
    public $successStatus = 200;

    public function index(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'id_project' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $listBoard=Board::where('id_project', $request['id_project'])->get();

        if($listBoard == NULL){
            $error='kosong';
            return response()->json($error, $this->successStatus);
        } else {
            return response()->json($listBoard, $this->successStatus);
        }
                                    
        //return response()->json($listBoard, $this->successStatus);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_project' => 'required',
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $board = Board::create($input);
        $success['name'] =  $board->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        $user = Auth::user();
        return response()->json(['success'=>$board], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        $user = Auth::user();
        $board->update($request->all());
        $success =  $board;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        $user = Auth::user();
        $board->delete();
        return response()->json(['success'=>'Success'], $this->successStatus);
    }

    public function addMember(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'id_board' => 'required|unique:member_of_boards,id_board,NULL,NULL,id_user,'.$user->id,
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $memberBoard = member_of_board::create($input);

        return response()->json(['success'=>'success'], $this->successStatus);
    }

    public function deleteMember(Request $request){
        $validator = Validator::make($request->all(),[
            'id_user' => 'required',
            'id_board' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        member_of_board::where('id_user', $request['id_user'])
                                    ->where('id_board', $request['id_board'])->delete();;
        
        return response()->json(['success'=>'Success'], $this->successStatus);
    }

    public function myBoard(Request $request){
      $user = Auth::user();
      $validator = Validator::make($request->all(),[
          'id_project' => 'required',
      ]);
      $listBoard = array();
      $listProject = $user->project;
      foreach ($listProject as $p) {
        if($p->id == $request['id_project']){
          $listBoard = Board::where('id_project', $request['id_project'])->get();
          break;
        }
      }
      return response()->json($listBoard);
    }
}
