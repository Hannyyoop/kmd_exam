<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResourceRepository implements ResourceRepositoryInterface
{
    public function index($model)
    {
        // Ensure the model is an instance of Model
        if (!is_subclass_of($model, Model::class)) {
            throw new \InvalidArgumentException("The provided class is not a valid Eloquent model.");
        }

        $query = $model::latest();



        return $query; // Return the query builder instance, not the paginated result
    }



    // public function selectOption($model)
    // {
    //     return $model::where('status', true)->orderBy('id')->get();
    // }

    // public function selectOption($model)
    // {
    //     $table = $model->getTable();
    //     $columns = Schema::getColumnListing($table);

    //     if (in_array('status', $columns)) {
    //         return $model::where('status', true)->orderBy('id')->get();
    //     } else {
    //         return $model::orderBy('id')->get();
    //     }
    // }
    public function create($model)
    {
        return new $model();
    }
    public function store($model, $data)
    {
        return $model::create($data);
    }
    public function find($model, $id)
    {
        return $model::find($id);
    }
    public function update($model, $data, $id)
    {
        return $model::findOrFail($id)->update($data);
    }
    public function destroy($model, $id)
    {
        return $model::findOrFail($id)->delete();
    }
    // public function changeStatus($model, $id)
    // {
    //     return tap($model::findOrFail($id), function ($status) {
    //         $status->update(['status' => !$status->status]);
    //     });
    // }
}
