<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /*************************************************************************************************/

    public function index()
    {
        // $projects=Project::all();
        $projects = Project::paginate(10);

        return response()->json ([
            'data'=>$projects,
            'status_code' => 200,
            'status' => 'success',
            'message' =>'تم جلب جميع المشاريع بنجاح!'
        ]);


    }



   /*************************************************************************************************/

    public function store(ProjectRequest $request)
    {

        $validated=$request->validated();


        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id = $request->user_id;

        $project->save();


         return response()->json([
            'data' => $project,
            'status_code' => 200,
            'status' => 'success',
            'message' => 'تم حفظ المشروع بنجاح!'
        ]);

    }

   /*************************************************************************************************/

    public function show(int $id)
    {
        $project = Project::findOrFail($id);
        return response()->json([
            'data' => $project,
            'status_code' => 200,
            'status' => 'success',
            'message' => 'تم جلب بيانات المشروع بنجاح!'
        ]);

    }


   /*************************************************************************************************/

    public function update(ProjectRequest $request, int $id)
    {
             $validated=$request->validated();

             $project = Project::findOrFail($id);
             $project->name = $request->name;
             $project->description = $request->description;
             $project->user_id = $request->user_id;

             $project->save();

             return response()->json([
                'data' => $project,
                'status_code' => 200,
                'status' => 'success',
                'message' => 'تم تعديل المشروع بنجاح!'
            ]);

    }


    /*************************************************************************************************/


    public function destroy(int $id)
    {
        $project = Project::find($id);
        $project->delete();
        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'message' => 'تم حذف المشروع بنجاح!'
        ]);

    }
}
