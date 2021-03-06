<?php

namespace App\Http\Controllers\API;

use App\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class CardController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listCard=Card::all();
        return response()->json($listCard, $this->successStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'id_board' => 'required',
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $board = Card::create($input);
        $success['name'] =  $board->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        $user = Auth::user();
        $task = $card->task;
        $card->grouping;
        $card['task'] = $task;
        return response()->json($card, $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }


        $card->update($request->all());
        return response()->json(['success'=>$card], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
      $user = Auth::user();
      $nameCard = $card->name;
      $card->delete();
      return response()->json("Card '".$nameCard."' deleted", $this->successStatus);

    }
    public function addMember(Request $request){
        $validator = Validator::make($request->all(),[
            'id_user' => 'required',
            'id_card' => 'required|unique:member_of_card,id_card,NULL,NULL,id_user,'.$user->id,
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $memberCard = member_of_card::create($input);

        return response()->json(['success'=>'success'], $this->successStatus);
    }
    public function deleteMember(Request $request){
      $validator = Validator::make($request->all(),[
          'id_user' => 'required',
          'id_card' => 'required',
      ]);
      $nameUser = User::find($request->id_user)->name;
      $nameCard = Card::find($request->id_card)->name;
      if($validator->fails()){
          return response()->json(['error'=>$validator->errors()], 401);
      }

      member_of_card::where('id_user', $request['id_user'])
                                  ->where('id_card', $request['id_card'])->delete();



      return response()->json("User '".$nameUser."' deleted from Card '".$nameCard."'", $this->successStatus);

    }
    public function myCard(){
      $user = Auth::user();
      $listCard = array();
      $card = $user->card;
      foreach ($card as $key) {
        $listCard[] = Card::find($key->id_card);
      }

      return response()->json($listCard);
    }
}
