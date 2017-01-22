<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/1/9
 * Time: 14:04
 */

namespace App\Repositories\Eloquent;


use App\Models\Category;

class CategoryRepositories extends BaseRepositories
{
    public function __construct(Category $category){
        $this->model = $category;
    }
    
    public function all(){
        $data = $this->model->orderBy('cate_order','asc')->get()->toArray();
        $cates = $this->getTree($data);
        return $cates;
    }

    public function getTree($data,$pid=0){
        $tmp = [];

        if(empty($data)){
            return '';
        }

        foreach ($data as $key=>$val){
            if($val['cate_pid']==$pid ){
                $tmp[$key]=$val;
                $tmp[$key]['son']=self::getTree($data,$val['cate_id']);
            }
        }
        return $tmp;
    }

    public function onelevelCate(){
        $class=$this->model->where('cate_pid',0)->get()->toArray();
        return $class;
    }

    public function getCateName($attribute,$value,$name){
        $cateName = $this->model->where($attribute,$value)->value($name);
        return $cateName;
    }
}