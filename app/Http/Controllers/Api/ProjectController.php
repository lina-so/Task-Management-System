<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /*************************************************************************************************/

    public function index()
    {
        $projects = Project::paginate(request()->page_size);
        $massage =" تم جلب جميع المشاريع بنجاح";
        return response()->success($projects,$massage);
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

        $massage =" تم إضافة المشروع بنجاح";

        return response()->success($project,$massage);


    }

   /*************************************************************************************************/

    public function show(int $id)
    {
        $project = Project::findOrFail($id);

        $massage =" تم جلب بيانات المشروع بنجاح!";

        return response()->success($project,$massage);

    }


   /*************************************************************************************************/

    public function update(UpdateProjectRequest $request, int $id)
    {
             $validated=$request->validated();

             $project = Project::findOrFail($id);
             $project->name = $request->name;
             $project->description = $request->description;
             $project->user_id = $request->user_id;

             $project->save();


            $massage =" تم تعديل المشروع بنجاح!";

            return response()->success($project,$massage);
    }


    /*************************************************************************************************/


    public function destroy(int $id)
    {
        $project = Project::find($id);
        if(!$project) {
            return response()->error('Object not found');
        }

        $project->delete();
        $massage =" تم حذف المشروع بنجاح!";
        return response()->success($project,$massage);



    }
}
