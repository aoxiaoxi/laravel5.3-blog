<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Eloquent\ArticleRepositories;
use App\Repositories\Eloquent\CategoryRepositories;
use App\Http\Requests;
use App\Http\Requests\StoreArticleRequest;

class ArticleController extends PublicController
{
    private $category;
    private $article;

    public function __construct(
        CategoryRepositories $categotyrepository,
        ArticleRepositories $articleRepository)
    {
        $this->category=$categotyrepository;
        $this->article=$articleRepository;
    }

    public function index(){
        $data=$this->article->all();
        return view('admin.article.index',compact('data'));
    }

    public function create(){
        $data = $this->category->all();
        return view('admin.article.add',compact('data'));
    }

    public function store(StoreArticleRequest $request){
        $input=$request->except('_token');
        $input['art_time']=date('Y-m-d H:i:s',time());

        if($this->article->create($input)){
            return redirect('admin/article');
        }
        else{
            return back()->withInput($input)->with('errors','数据插入失败！');
        }

    }
    public function destroy($art_id){
        $re=$this->article->delete('art_id',$art_id);
        if($re){
            $data=[
                'status'=>1,
                'msg'=>'删除成功！'
            ];
        }
        else{
            $data=[
                'status'=>0,
                'msg'=>'删除失败！'
            ];
        }
        return $data;
    }
    public function edit($art_id){
        $data1=$this->category->all();
        $data=$this->article->find($art_id);

        return view('admin.article.edit',compact('data','data1'));
    }

    public function update(StoreArticleRequest $request,$art_id){
        $input=$request->except(['_token','_method']);
        $re=$this->article->update($art_id,$input,'art_id');

        if($re){
            return redirect('admin/article');
        }
    }

}
