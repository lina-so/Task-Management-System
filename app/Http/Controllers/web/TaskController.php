<?php

namespace App\Http\Controllers\web;

use App\Models\Tag;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Traits\ModelQueryTrait;

class TaskController extends Controller
{
    use ModelQueryTrait;

    /*************************************************************************************************/

    public function index()
    {
        $tasks = $this->getAll(new Task);
        $projects = $this->getAll(new Project);
        $tags = $this->getAll(new Tag);

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
        $data = $request->all();
        $task = $this->createRecord(new Task(),$data);

        // dd($request->tag_id);
        $task->tags()->attach($request->tag_id);

        return redirect()->route('task.index')
          ->with('success_task','تم اضافة التاسك بنجاح');
    }

   /*************************************************************************************************/

    public function show($id)
    {
        // $task = Task::findOrFail($id);
        $task = $this->getByIdWithRelation(new Task(),$id,[]);

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
        $data = $request->all();
        $task = $this->updateRecord(new Task(),$id,$data);
        $task->tags()->sync($request->tag_id);

        return redirect()->route('task.index')
          ->with('update_task','تم تعديل معلومات التاسك بنجاح');
    }


    /*************************************************************************************************/

    public function destroy($id)
    {
        $task = $this->deleteRecord(new Task(),$id);
        $task->delete();
        return redirect()->route('task.index')
        ->with('delete_task','تم حذف التاسك بنجاح');
    }
}
