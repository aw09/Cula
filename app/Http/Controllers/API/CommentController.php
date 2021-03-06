<?php

namespace App\Http\Controllers\API;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $successStatus = 200;
    public function index(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'id_task' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $listComment=Comment::where('id_task', $request['id_task'])->get();

        if($listComment == NULL){
            $error='kosong';
            return response()->json($error, $this->successStatus);
        } else {
            return response()->json($listComment, $this->successStatus);
        }

        //return response()->json($listBoard, $this->successStatus);
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
        $validator = Validator::make($request->all(),[
            'id_user' => 'required',
            'id_task' => 'required',
            'comment' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);

        }

        $input = $request->all();
        $comment = Comment::create($input);
        $success =  $comment;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(comment $comment)
    {
        return response()->json(['success'=>$comment], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, comment $comment)
    {
        $validator = Validator::make($request->all(),[
            'id_user' => 'required',
            'id_task' => 'required',
            'comment' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $comment->update($request->all());
        $success =  $comment;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(comment $comment)
    {
        $comment->delete();
        return response()->json(['success'=>'Success'], $this->successStatus);
    }

    public function listOfComment(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'id_task' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $listComment=Comment::where('id_task', $request['id_task'])->get();

        if($listComment == NULL){
            $error='kosong';
            return response()->json($error, $this->successStatus);
        } else {
            return response()->json($listComment, $this->successStatus);
        }

    }
}
