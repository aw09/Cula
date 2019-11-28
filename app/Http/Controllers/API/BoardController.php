<?php

namespace App\Http\Controllers\API;

use App\Board;
use App\member_of_board;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class BoardController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        $user = Auth::user();
        $board = Board::all();
        return response()->json($board, $this->successStatus);
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
        $req['id_user'] = $user->id;
        $req['id_board'] = $board->id;
        $memberBoard = member_of_board::create($req);
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
      $listComplete = array();
      $listCard=$board->card;
      foreach ($listCard as $key) {
        $group = $key->grouping;
        $key['ungroup'] = array();
        $key['group'] = array();
        $i = 0;
        $temp = array();
        foreach ($group as $g) {
          $g->task;
          $temp[$i] = $g;
          $i++;
        }
        $key['group'] = $temp;
        $ungroup = $key->task;
        $i = 0;
        $temp = array();
        foreach ($ungroup as $u) {
          if($u->id_grouping==NULL){
            $temp[$i] = $u;
            $i++;
          }
        }
        $key['ungroup'] = $temp;
        $board['card'] = $listComplete;
        $listComplete[] = $key;
        $collection = collect($board);
        $collection->forget($board->grouping);
      }
      if($listCard == NULL){
          $error='Project not found';
          return response()->json($error, 404);
      } else {
          return response()->json($collection, $this->successStatus);
      }
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
        $nameBoard = $board->name;
        $board->delete();
        return response()->json("Board '".$nameBoard."' deleted", $this->successStatus);
    }

    public function addMember(Request $request){
      $user = Auth::user();
      $validator = Validator::make($request->all(),[
          'id_user' => 'required|unique_with:member_of_boards, id_board',
          'id_board' => 'required',
      ]);

      if($validator->fails()){
          return response()->json([$validator->errors()], 401);
      }
      $nameUser = User::find($request->id_user)->name;
      $nameBoard = Board::find($request->id_board)->name;
      $input = $request->all();
      $memberBoard = member_of_board::create($input);

      return response()->json(["User '".$nameUser."' added to Board '".$nameBoard."'"], $this->successStatus);
    }

    public function deleteMember(Request $request){
      $validator = Validator::make($request->all(),[
          'id_user' => 'required',
          'id_board' => 'required',
      ]);
      $nameUser = User::find($request->id_user)->name;
      $nameBoard = Board::find($request->id_board)->name;
      if($validator->fails()){
          return response()->json(['error'=>$validator->errors()], 401);
      }

      member_of_board::where('id_user', $request['id_user'])
                                  ->where('id_board', $request['id_board'])->delete();



      return response()->json("User '".$nameUser."' deleted from Board '".$nameBoard."'", $this->successStatus);

    }

    public function myBoard(){
      $user = Auth::user();
      $board = $user->board;
      $listBoard = array();
      foreach ($board as $key) {
        $listBoard[] = Board::find($key->id_board);
      }

      return response()->json($listBoard);

    }

    public function boardOfProject(Request $request){
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
