<?php

namespace App\Http\Controllers\API;

use App\Cluster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $successStatus = 200;
    public function index()
    {
        $cluster = Cluster::all();
        return response()->json(['success'=>$cluster], $this->successStatus);
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
            'cluster' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);

        }

        $input = $request->all();
        $cluster = Cluster::create($input);
        $success =  $cluster;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function show(cluster $cluster)
    {
        return response()->json(['success'=>$cluster], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function edit(cluster $cluster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cluster $cluster)
    {
        $validator = Validator::make($request->all(),[
            'cluster' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'error']);
        }

        $cluster->update($request->all());
        $success =  $cluster;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function destroy(cluster $cluster)
    {
        $cluster->delete();
        return response()->json(['success'=>'Success'], $this->successStatus);
    }

    public function addCluster(Request $request){
        $validator = Validator::make($request->all(),[
            'id_card' => 'required',
            'id_cluster' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $clustering = Clustering::create($input);

        return response()->json([$clustering], $this->successStatus);
    }

    public function getCluster(Request $request){
      $user = Auth::user();
      $validator = Validator::make($request->all(),[
          'id_project' => 'required'
      ]);
      if($validator->fails()){
          return response()->json(['error'=>$validator->errors()], 401);
      }
      $cluster = Cluster::find($request->id_cluster);

      return response()->json([$cluster], $this->successStatus);
    }
}
