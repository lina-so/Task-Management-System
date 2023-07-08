<?php

namespace App\Http\Controllers\web;

use App\Models\Tag;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /*************************************************************************************************/

    public function index()
    {
        $tasks = Task::all();
        $projects = Project::all();
        $tags = Tag::all();


        return view('pages.task.index',compact('projects','tasks','tags'));
    }

    /*************************************************************************************************/

    public function create()
    {
        //
    }

  /*************************************************************************************************/

    public function store(TaskRequest $request)
    {
          $validated=$request->validated();


          $task = new Task();
          $task->name = $request->name;
          $task->description = $request->description;
          $task->project_id = $request->project_id;

          $task->save();
        // dd($request->tag_id);
          $task->tags()->attach($request->tag_id);

          return redirect()->route('task.index')
          ->with('success_task','تم اضافة التاسك بنجاح');
    }

   /*************************************************************************************************/

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('pages.task.show',compact('task'));

    }

  /*************************************************************************************************/

    public function edit(Task $project)
    {
        //
    }

   /*************************************************************************************************/

    public function update(UpdateTaskRequest $request, $id)
    {
          $validated=$request->validated();

          $task = Task::findOrFail($id);
          $task->name = $request->name;
          $task->description = $request->description;
          $task->project_id = $request->project_id;

          $task->save();

          $task->tags()->sync($request->tag_id);

          return redirect()->route('task.index')
          ->with('update_task','تم تعديل معلومات التاسك بنجاح');
    }


    /*************************************************************************************************/

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('task.index')
        ->with('delete_task','تم حذف التاسك بنجاح');
    }
}
