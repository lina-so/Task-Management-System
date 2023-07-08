<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{


      /*******************************************************************************************************************/
      public function search(Request $request)
      {

          $radio = $request->radio;

          // في حالة البحث  باسم اليوزر

              if ($radio == 1) {

                  $user_name = $request->input('user_name');

                  $user = User::where('name', $user_name)->first();

                  if (!$user) {
                      return redirect()->back()->with('error', 'User not found');
                  }

                  $projects = $user->projects;

                  $massage =" تم جلب جميع بيانات المشروع بنجاح";
                  return response()->success($projects,$massage);


              }


           // في البحث باسم المشروع
           else  if ($radio == 2){
            $project_name = $request->input('project_name');

            $projects = Project::where('name', $project_name)->get();

            if (!$projects) {
                return redirect()->back()->with('error', 'project not found');
            }

            $massage =" تم جلب جميع بيانات المشروع بنجاح";
            return response()->success($projects,$massage);

        }

    //====================================================================
           // في البحث باسم التاغ

    else
    {
        $tagname = $request->input('tag_name');

        $projects = DB::table('projects')
        ->join('tasks', 'tasks.project_id', '=', 'projects.id')
        ->join('task_tag', 'task_tag.task_id', '=', 'tasks.id')
        ->join('tags', 'tags.id', '=', 'task_tag.tag_id')
        ->join('users', 'users.id', '=', 'projects.user_id')
        ->where('tags.name', $tagname)
        ->select('projects.*')
        ->distinct()
        ->get();

        $user_name = DB::table('projects')
        ->join('tasks', 'tasks.project_id', '=', 'projects.id')
        ->join('task_tag', 'task_tag.task_id', '=', 'tasks.id')
        ->join('tags', 'tags.id', '=', 'task_tag.tag_id')
        ->join('users', 'users.id', '=', 'projects.user_id')
        ->where('tags.name', $tagname)
        ->select('users.name')
        ->distinct()
        ->get();

        $massage =" تم جلب جميع بيانات المشروع بنجاح";
        return response()->success($projects,$massage);

    }

}

/*******************************************************************************************************************/


}
