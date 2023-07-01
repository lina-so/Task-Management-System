<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;


class ProjectController extends Controller
{
    /*************************************************************************************************/

    public function index()
    {
        // $projects = Project::all();
        $projects = Project::paginate(10);
        $users = User::all();

        return view('pages.project.index',compact('projects','users'));
    }

    /*************************************************************************************************/

    public function create()
    {
        //
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


        return redirect()->route('project.index')
        ->with('success','تم حفظ معلومات المشروع بنجاح');
    }

   /*************************************************************************************************/

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('pages.project.show',compact('project'));

    }

  /*************************************************************************************************/

    public function edit(Project $project)
    {
        //
    }

   /*************************************************************************************************/

    public function update(ProjectRequest $request, $id)
    {
          $validated=$request->validated();

          $project = Project::findOrFail($id);
          $project->name = $request->name;
          $project->description = $request->description;
          $project->user_id = $request->user_id;

          $project->save();

          return redirect()->route('project.index')
          ->with('update','تم تعديل معلومات المشروع بنجاح');
    }


    /*************************************************************************************************/

    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('project.index')
        ->with('delete','تم حذف المشروع بنجاح');
    }
}
