<?php


namespace App\Repositories\Eloquent;


abstract class AbstractRepository
{
    protected $model;
    function __construct()
    {
        $this->model=$this->resolveModel();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function all(){

        return $this->model->all();
    }
}
