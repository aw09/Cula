<?php

namespace App\Http\Controllers\API;

use App\Board;
use App\member_of_board;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        $user = Auth::user();
        $board = Board::all();
        return response()->json(['success'=>$board], $this->successStatus);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
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

        $req['id_user'] = $user->id;
        $req['id_board'] = $board->id;
        $req = new Request($req);
        $this->addMember($req);

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
            'id_user' => 'required',
            'id_board' => 'required',
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
