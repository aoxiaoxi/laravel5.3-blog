<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/1/13
 * Time: 17:20
 */

namespace App\Repositories\Eloquent;



use App\Models\Link;

class LinkRepositories extends BaseRepositories
{
    public function __construct(Link $link)
    {
        $this->model=$link;
    }

    public function all()
    {
        $data = $this->model->orderBy('link_order','asc')->get();
        return $data;
    }

    public function find($id){
        $info=$this->model->find($id);
        return $info;
    }
}