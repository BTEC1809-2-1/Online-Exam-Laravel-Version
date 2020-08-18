<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->makeModel();
    }

    abstract public function model();

    protected function makeModel()
    {
        $model = app()->make($this->model());
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function findBy($attribute, $value, $columns = ['*']) {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }
    
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }
        return false;
    }
}