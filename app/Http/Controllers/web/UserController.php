<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Traits\ModelQueryTrait;

class UserController extends Controller
{
    use ModelQueryTrait;
 /*******************************************************************************************************************/

    public function index()
    {
        $users = $this->getAll(new User);
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

        $data = $request->all();
        $user = $this->createRecord(new User(),$data);

        return redirect()->route('user.index')
          ->with('success_user','تم حفظ معلومات المستخدم بنجاح');


    }

    /*******************************************************************************************************************/
    public function show(int $id)
    {
        // $user = User::findOrFail($id);
        $user = $this->getByIdWithRelation(new User(),$id,[]);

        return view('pages.user.show',compact('user'));
    }

    /*******************************************************************************************************************/

    public function edit(string $id)
    {
        //
    }
    /*******************************************************************************************************************/

    public function update(UpdateUserRequest $request, int $id)
    {
        $validated=$request->validated();
        $user = $this->updateRecord(new User(),$id,$validated);


        return redirect()->route('user.index')
        ->with('update_user','تم تعديل معلومات المستخدم بنجاح');
    }

    /*******************************************************************************************************************/

    public function destroy($id)
    {
        // $user = User::find($id);

        $user = $this->deleteRecord(new User(),$id);
        $user->delete();
        return redirect()->route('user.index')
        ->with('delete_user','تم حذف المستخدم بنجاح');
    }
}
