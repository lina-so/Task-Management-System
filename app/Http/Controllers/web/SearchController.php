<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
     /*******************************************************************************************************************/

    public function index()
    {
        return view('pages.project.search');
    }

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

                return view('pages.project.search_result', compact('projects','radio'));

            }


        //====================================================================

        // في البحث باسم المشروع
            else  if ($radio == 2){
                $project_name = $request->input('project_name');

                $projects = Project::where('name', $project_name)->get();

                if (!$projects) {
                    return redirect()->back()->with('error', 'project not found');
                }

                return view('pages.project.search_result', compact('projects','radio'));

            }

        //====================================================================

        else
        {
            $tag_name = $request->input('tag_name');

            $projects = DB::table('projects')
            ->join('tasks', 'tasks.project_id', '=', 'projects.id')
            ->join('task_tag', 'task_tag.task_id', '=', 'tasks.id')
            ->join('tags', 'tags.id', '=', 'task_tag.tag_id')
            ->join('users', 'users.id', '=', 'projects.user_id')
            ->where('tags.name', $tag_name)
            ->select('projects.*')
            ->distinct()
            ->get();

            $user_name = DB::table('projects')
            ->join('tasks', 'tasks.project_id', '=', 'projects.id')
            ->join('task_tag', 'task_tag.task_id', '=', 'tasks.id')
            ->join('tags', 'tags.id', '=', 'task_tag.tag_id')
            ->join('users', 'users.id', '=', 'projects.user_id')
            ->where('tags.name', $tag_name)
            ->select('users.name')
            ->distinct()
            ->get();

          return view('pages.project.search_result', compact('projects','user_name','radio'));

        }
        // dd($radio);

    }

    /*******************************************************************************************************************/


}
