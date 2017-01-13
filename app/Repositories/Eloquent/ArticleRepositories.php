<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/1/11
 * Time: 16:14
 */

namespace App\Repositories\Eloquent;


use App\Models\Article;

class ArticleRepositories extends BaseRepositories
{
    public function __construct(Article $article)
    {
        $this->model=$article;
    }

    public function all(){
        $data=$this->model->orderBy('art_id','desc')->paginate(6);
        return $data;

    }
}