<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks =Task::all();
        return response()->json($tasks);
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
    public function store(StoreTaskRequest $request)
    {
        $data[ 'name'] =$request->name ;
        $data['describe'] =$request->describe ;
        $data['project_id'] =$request->project_id ;
        $data['team_id'] =$request->team_id ;
        $data['start_time'] =$request->start_time ? $request->start_time :carbon::now() ;
        $data['end_time'] =$request->end_time ? $request->end_time : Carbon::tomorrow() ;
        $data[ 'status'] =$request->status ;

        $task =Task::create($data);
        return response()->json([
            'status'=>true,
            'date' =>$task,
            'message' => 'Task Add Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $task = Task::findOrFail($request->id);
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        if($task)
        {
            $data[ 'name'] =$request->name ? $request->name : $task->name ;
            $data['describe'] =$request->describe ? $request->describe :$task->describe ;
            $data['project_id'] =$request->project_id ? $request->project_id :$task->project_id ;
            $data['team_id'] =$request->team_id ? $request->team_id : $task->team_id  ;
            $data['start_time'] =$request->start_time ? $request->start_time :$task->start_time ;
            $data['end_time'] =$request->end_time ? $request->end_time :$task->end_time ;
            $data[ 'status'] =$request->status ? $request->status : $task->status ;

            $task->update($data);
            return response()->json([
                'status'=>true,
                'data' => $task,
                'message' => 'Task Updated Successfully',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Task::where('id' , $request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Task deleted Successfully',
        ]);
    }
}
