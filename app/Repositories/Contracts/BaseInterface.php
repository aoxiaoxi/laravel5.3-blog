<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/1/9
 * Time: 12:13
 */

namespace App\Repositories\Contracts;


interface BaseInterface
{
    public function all();

    public function find($id);

    public function findBy($attribute,$value);

    public function update($value,array $data,$attribute='id');

    public function create(array $data);

    public function delete($attribute,$value);
}