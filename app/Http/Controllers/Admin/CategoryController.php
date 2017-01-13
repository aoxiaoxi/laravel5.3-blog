<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCategoryRequest;
use App\Repositories\Eloquent\CategoryRepositories;
use Illuminate\Http\Request;

class CategoryController
{
    protected $category;

    public function __construct(CategoryRepositories $category){
        $this->category = $category;
    }

    public function index(){
        $cates = $this->category->all();
        return view('admin.category.index',compact('cates'));
    }

    public function create(){
        $data=$this->category->findBy('cate_pid','0');
        return view('admin.category.add')->with('data',$data);
    }

    public function store(StoreCategoryRequest $request)
    {
        $input = $request->except('_token');

        $re = $this->category->create($input);

        if ($re) {
            return redirect('admin/category/index');
        } else {
            return back()->withInput()->with('errors', '分类创建失败');
        }
    }

    public function delete(Request $request){
        $cate_id = $request->cate_id;
        $category=$this->category->find($cate_id);

        if($category['cate_pid']==0){
            $this->category->update($cate_id,['cate_pid'=>0],'cate_pid');
        }

        if($this->category->delete('cate_id',$cate_id)){
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

    public function edit(Request $request,$cate_id){
        $field = $this->category->find($cate_id);
        $data=$this->category->findBy('cate_pid','0');

        return view('admin.category.edit',compact('field','data'));
    }

    public function update(StoreCategoryRequest $request,$cate_id){
        $input = $request->except('_token');

        $re = $this->category->update($cate_id,$input,'cate_id');

        if ($re) {
            return redirect('admin/category/index');
        } else {
            return back()->withInput()->with('errors', '分类修改失败');
        }
    }

    public function changeOrder(Request $request){
        echo $request->cate_id;
        exit;
        $category=$this->category->find($request->cate_id);
        $category['cate_order']=$request->cate_order;
        if($category->update()){
            $data=[
                'status'=>1,
                'msg'=>'分类排序更新成功'
            ];
        }else{
            $data=[
                'status'=>0,
                'msg'=>'分类排序更新失败'
            ];
        }
        return $data;
    }

}
