<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\API;

use App\Cards;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CardsController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $validator = Validator::make($request->all(),[
            'id_board' => 'required',
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $board = Cards::create($input);
        $success['name'] =  $board->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cards  $cards
     * @return \Illuminate\Http\Response
     */
    public function show(Cards $cards)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cards  $cards
     * @return \Illuminate\Http\Response
     */
    public function edit(Cards $cards)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cards  $cards
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cards $cards)
    {
        //
        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $card->update($request->all());
        $success =  $card;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cards  $cards
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cards $cards)
    {
        //
        $cards->delete();
        return response()->json(['success'=>'Success'], $this->successStatus);
    }
}
