<?php

namespace App\Http\Controllers\web;

use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Traits\ModelQueryTrait;


class ProjectController extends Controller
{
    use ModelQueryTrait;

    /*************************************************************************************************/

    public function index()
    {
        // $projects = Project::paginate(10);
        // $users = User::all();
        // $tags = Tag::all();

        $projects = $this->getAllWithPaginate(new Project);
        $users = $this->getAll(new User);
        $tags = $this->getAll(new Tag);

        return view('pages.project.index',compact('projects','users','tags'));
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

        $data = $request->all();
        $project = $this->createRecord(new Project(),$data);

        //   $project = new Project();
        //   $project->name = $request->name;
        //   $project->description = $request->description;
        //   $project->user_id = $request->user_id;

        //   $project->save();


        return redirect()->route('project.index')
        ->with('success','تم حفظ معلومات المشروع بنجاح');
    }

   /*************************************************************************************************/

    public function show($id)
    {
        // $project = Project::findOrFail($id);
        $project = $this->getByIdWithRelation(new Project(),$id,[]);
        return view('pages.project.show',compact('project'));

    }

  /*************************************************************************************************/

    public function edit(Project $project)
    {
        //
    }

   /*************************************************************************************************/

    public function update(UpdateProjectRequest $request, $id)
    {
        $validated=$request->validated();

        //   $project = Project::findOrFail($id);
        //   $project->name = $request->name;
        //   $project->description = $request->description;
        //   $project->user_id = $request->user_id;

        //   $project->save();

        $project = $this->updateRecord(new Project(),$id,$validated);

        return redirect()->route('project.index')
          ->with('update','تم تعديل معلومات المشروع بنجاح');
    }


    /*************************************************************************************************/
    public function suggestProjectTags($id)
    {
        $project = Project::findOrFail($id);
        $sugg_tags = $project->tasks()->with('tags')->get()->pluck('tags')->flatten()->unique();
        $tags = Tag::all();

        // $tags = $project->tags;
        // dd($tags);

        return view('pages.project.project_tags',compact('project','tags','sugg_tags'));
    }

    public function destroy($id)
    {
        $project = $this->deleteRecord(new Project(),$id);

        $project->delete();
        return redirect()->route('project.index')
        ->with('delete','تم حذف المشروع بنجاح');
    }
}
