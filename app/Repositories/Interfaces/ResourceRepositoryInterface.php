<?php

namespace App\Repositories\Interfaces;

interface ResourceRepositoryInterface
{
    public function index($model);
    // public function selectOption($model);
    public function create($model);
    public function store($model, $data);
    public function find($model, $id);
    public function update($model, $data, $id);
    public function destroy($model, $id);
    // public function search($columns, $model);
    // public function changeStatus($model, $id);
}
