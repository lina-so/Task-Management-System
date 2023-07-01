<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

 /*******************************************************************************************************************/

    public function index()
    {
        $users = User::all();
        return view('pages.user.index',compact('users'));
    }

    /*******************************************************************************************************************/

    public function create()
    {
        //
    }

   /*******************************************************************************************************************/

    public function store(UserRequest $request)
    {
        $validated=$request->validated();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('user.index')
          ->with('success_user','تم حفظ معلومات المستخدم بنجاح');


    }

    /*******************************************************************************************************************/
    public function show(int $id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.show',compact('user'));
    }

    /*******************************************************************************************************************/

    public function edit(string $id)
    {
        //
    }
    /*******************************************************************************************************************/

    public function update(UserRequest $request, int $id)
    {
        $validated=$request->validated();

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('user.index')
        ->with('update_user','تم تعديل معلومات المستخدم بنجاح');
    }

    /*******************************************************************************************************************/

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')
        ->with('delete_user','تم حذف المستخدم بنجاح');
    }
}
