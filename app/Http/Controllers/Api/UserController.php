<?php

namespace App\Http\Controllers\Api;

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
      return response()->json ([
        'status_code' => 200,
        'status' => 'success',
        'data' => $users,
        'message' => 'تم جلب البيانات  بنجاح!'
    ]);
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


        return response()->json ([
            'status_code' => 200,
            'status' => 'success',
            'data' => $user,
            'message' => 'تم اضافة المستخدم بنجاح!'
        ]);

    }

    /*******************************************************************************************************************/
    public function show(int $id)
    {
        $user = User::findOrFail($id);

        return response()->json ([
            'status_code' => 200,
            'status' => 'success',
            'data' => $user,
            'message' => 'تم جلب بيانات المستخدم بنجاح!'
        ]);
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

        return response()->json ([
            'status_code' => 200,
            'status' => 'success',
            'data' => $user,
            'message' => 'تم تعديل بيانات المستخدم بنجاح!'
        ]);
    }

    /*******************************************************************************************************************/

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json ([
            'status_code' => 200,
            'status' => 'success',
            'message' => 'تم حذف  المستخدم بنجاح!'

        ]);
    }
}
