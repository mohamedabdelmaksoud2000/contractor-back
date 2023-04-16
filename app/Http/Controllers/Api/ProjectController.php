<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $request->file('image')->store('project_image','public');

        $projects=Project::create($request->all());
        return response()->json([
            'status'=>true,
            'date' =>$projects,
            'message' => 'Company Information Added Successfully',
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
        $projects = Project::findOrFail($request->id);
        return response()->json($projects);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $project = project::findOrFail($id);
        if($project)
        {
            $data['name']  = $request->name ? $request->name : $project->name;
            $data['describe']  =$request->describe ? $request->describe : $project->describe;
            $data['budget'] =$request->budget ? $request->budget : $project->budget;
            $data['image' ]   =$request->image ? $request->image : $project->image  ;
            $data['supervisor_id']    =$request->supervisor_id ? $request->supervisor_id : $project->supervisor_id;
            $data[ 'start_time' ]        =$request->start_time ? $request->start_time : $project->start_time; 
            $data[ 'end_time' ]      =$request->end_time ? $request->end_time : $project->end_time;
                $project->update($data);
            return response()->json([
                'status'=>true,
                'data' => $project,
                'message' => 'project Information Updated Successfully',
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::find($id)->delete();
            return response()->json([
            'status'=>true,
            'message' => 'project Information deleted Successfully',
        ]);
    }
}
