<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /*************************************************************************************************/

    public function index()
    {
        // $projects = Project::all();
        $tasks = Task::all();
        $projects = Project::all();
        $tags = Tag::all();


        return response()->json ([
            'status_code' => 200,
            'status' => 'success',
            'data' => $tasks,
            'message' => 'تم جلب االبيانات  بنجاح!'
        ]);
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


        return response()->json ([
            'status_code' => 200,
            'status' => 'success',
            'data' => $task,
            'message' => 'تم اضافة التاسك بنجاح!'
        ]);
    }

   /*************************************************************************************************/

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json ([
            'status_code' => 200,
            'status' => 'success',
            'data' => $task,
            'message' => 'تم جلب بيانات التاسك بنجاح!'

        ]);
    }

  /*************************************************************************************************/

    public function edit(Task $project)
    {
        //
    }

   /*************************************************************************************************/

    public function update(TaskRequest $request, $id)
    {
          $validated=$request->validated();

          $task = Task::findOrFail($id);
          $task->name = $request->name;
          $task->description = $request->description;
          $task->project_id = $request->project_id;

          $task->save();

          $task->tags()->sync($request->tag_id);

        return response()->json ([
            'status_code' => 200,
            'status' => 'success',
            'data' => $task,
            'message' => 'تم تعديل بيانات التاسك بنجاح!'
        ]);
    }


    /*************************************************************************************************/

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return response()->json ([
            'status_code' => 200,
            'status' => 'success',
            'message' => 'تم حذف  التاسك بنجاح!'
        ]);
    }
}
