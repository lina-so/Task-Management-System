<?php

namespace App\Http\Controllers\Api;

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
        // $projects = Project::all();
        $tasks = Task::all();
        $projects = Project::all();
        $tags = Tag::all();
        $massage ='تم جلب التاسكات  بنجاح!';
        return response()->success($tasks,$massage);


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

          $task->tags()->attach($request->tag_id);

          $massage =" تم إضافة التاسك بنجاح";

          return response()->success($task,$massage);


    }

   /*************************************************************************************************/

    public function show($id)
    {
        $task = Task::findOrFail($id)->with(['project'])->first();
        $massage ="تم جلب بيانات التاسك بنجاح!";

        return response()->success($task,$massage);

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
          $massage = 'تم تعديل بيانات التاسك بنجاح!';

          return response()->success($task,$massage);

    }


    /*************************************************************************************************/

    public function destroy($id)
    {
        $task = Task::find($id);
        if(!$task) {
            return response()->error('Object not found');
        }
        $task->delete();
        $massage = 'تم حذف  التاسك بنجاح!';
        return response()->success($task,$massage);


    }
}
