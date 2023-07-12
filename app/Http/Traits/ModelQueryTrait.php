<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;

trait ModelQueryTrait
{
    /**
     * Get all records for a given model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */

     //index()
    public function getAll(Model $model)
    {
        return $model->all();
    }
  /*************************************************************************************************/

    public function getAllWithPaginate(Model $model)
    {
        return $model->paginate(request()->page_size);
    }
  /*************************************************************************************************/
     //store()
    public function createRecord(Model $model , array $data)
    {
        return $model->create($data);
    }
  /*************************************************************************************************/
     //show()
    public function getByIdWithRelation(Model $model, int $id, array $relations = [])
    {
       return $model->findOrFail($id)->with($relations)->first();


    }

  /*************************************************************************************************/
    //update()
    public function updateRecord(Model $model ,int $id , array $data)
    {
        // return $model::findOrFail($id)->update($data);
        $record = $model->findOrFail($id);
        $record->fill($data);
        $record->save();

        return $record;

    }
  /*************************************************************************************************/
    //destroy()
    public function deleteRecord(Model $model , int $id)
    {
        return $model->find($id);
    }

}
