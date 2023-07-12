<?php

namespace App\Http\Controllers\Api;

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

        $data = $request->all();
        $task = $this->createRecord(new Task(),$data);

        $task->tags()->attach($request->tag_id);

        $massage =" تم إضافة التاسك بنجاح";
        return response()->success($task,$massage);


    }

   /*************************************************************************************************/

    public function show($id)
    {
        // $task = Task::findOrFail($id)->with(['project'])->first();
        $task = $this->getByIdWithRelation(new Task(),$id,['project']);

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
        $data = $request->all();
        $task = $this->updateRecord(new Task(),$id,$data);

        $task->tags()->sync($request->tag_id);
        $massage = 'تم تعديل بيانات التاسك بنجاح!';

        return response()->success($task,$massage);

    }


    /*************************************************************************************************/

    public function destroy($id)
    {
        $task = $this->deleteRecord(new Task(),$id);

        if(!$task) {
            return response()->error('Object not found');
        }
        $task->delete();
        $massage = 'تم حذف  التاسك بنجاح!';
        return response()->success($task,$massage);


    }
}
