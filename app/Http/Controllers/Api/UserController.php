<?php

namespace App\Http\Controllers\Api;

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
        $massage = 'تم جلب البيانات بنجاح!';

        return response()->success($users,$massage);
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

        $massage = 'تم اضافة المستخدم بنجاح!';

        return response()->success($user,$massage);


    }

    /*******************************************************************************************************************/
    public function show(int $id)
    {

        try {
            // $user = User::with(['projects'])->findOrFail($id);
            $user = $this->getByIdWithRelation(new User(),$id,['projects']);
        } catch(ModelNotFoundException $e) {
            return response()->error('المستخدم المحدد غير موجود', 404);
        }

        $massage = "تم جلب بيانات المستخدم بنجاح!";

        return response()->success($user,$massage);

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

        $massage = 'تم تعديل بيانات المستخدم بنجاح!';
        return response()->success($user,$massage);

    }

    /*******************************************************************************************************************/

    public function destroy($id)
    {
        // $user = User::find($id);
        $user = $this->deleteRecord(new User(),$id);
        if(!$user) {
            return response()->error('Object not found');
        }

        $user->delete();
        $massage = 'تم حذف المستخدم بنجاح!';
        return response()->success($user,$massage);

    }
}
