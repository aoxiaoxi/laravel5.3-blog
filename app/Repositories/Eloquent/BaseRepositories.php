<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/1/9
 * Time: 12:16
 */

namespace App\Repositories\Eloquent;


use App\Repositories\Contracts\BaseInterface;

class BaseRepositories implements BaseInterface
{
    protected $model;

    public function all(){
        return $this->model->all()->toArray();
    }

    public function find($id){
        return $this->model->find($id)->toArray();
    }

    public function findBy($attribute,$value){
        return $this->model->where($attribute,$value)->get();
    }

    public function update($value,array $data,$attribute='id'){
        return $this->model->where($attribute,$value)->update($data);
    }

    public function create(array $data){
        return $this->model->create($data);
    }

    public function delete($attribute,$value){
        return $this->model->where($attribute,$value)->delete();
    }
}