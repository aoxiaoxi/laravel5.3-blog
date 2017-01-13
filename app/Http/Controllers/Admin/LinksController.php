<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreLinkRequest;
use App\Repositories\Eloquent\LinkRepositories;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends PublicController
{
    private $link;
    public function __construct(LinkRepositories $linkrepository)
    {
        $this->link=$linkrepository;
    }

    public function index(){
        $data=$this->link->all();
        return view('admin.links.index',compact('data'));
    }

    public function changeOrder(Request $request){
        $input=$request->except('_token');
        $re=$this->link->update($input['link_id'],['link_order'=>$input['link_order']],'link_id');
        if($re){
            $data=[
                'status'=>1,
                'msg'=>'排序成功！'
            ];
        }
        else{
            $data=[
                'status'=>0,
                'msg'=>'排序失败！'
            ];
        }
        return $data;
    }

    public function create(){
        return view('admin.links.add');
    }
    public function store(StoreLinkRequest $request){
        $input=$request->except('_token');

        $re=$this->link->create($input);
        if($re){
              return redirect('admin/links');
        }
        else{
            return back()->with('errors','数据库填充失败，请稍后重试！');
        }

    }

    public function edit($link_id){
        $data=$this->link->find($link_id);
        return view('admin.links.edit',compact('data'));
    }
    public function update(StoreLinkRequest $request,$link_id){
        $input=$request->except('_token','_method');

        $re=$this->link->update($link_id,$input,'link_id');
        if($re){
            return redirect('admin/links');
        }
        else{
            return back()->with('errors','请输入修改内容！');
        }

    }
    public function destroy($link_id){
        $re=$this->link->delete('link_id',$link_id);
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
    public function show(){
        
    }

}
