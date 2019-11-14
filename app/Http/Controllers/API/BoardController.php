<?php

namespace App\Http\Controllers\API;

use App\Board;
use App\member_of_board;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;

class BoardController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        $board = Board::all();
        return response()->json(['success'=>$board], $this->successStatus);
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
        $board->delete();
        return response()->json(['success'=>'Success'], $this->successStatus);
    }

    public function addMember(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'id_board' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $memberBoard = member_of_board::create($input);

        return response()->json(['success'=>'success'], $this->successStatus);
    }
    public function myBoard(){
      $user = Auth::user();
      $listBoard = array();
      $board = $user->board;
      foreach ($board as $key) {
        $listBoard[] = Board::find($key->id_board);
      }

      return response()->json($listBoard);
    }
}
