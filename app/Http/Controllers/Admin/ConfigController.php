<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\ConfigRepositories;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConfigRequest;

class ConfigController extends Controller
{
    private $config;
    public function __construct(ConfigRepositories $configRepositories)
    {
        $this->config=$configRepositories;
    }

    //get.admin/configs  全部配置项列表
    public function index()
    {
        $data = $this->config->all();
        foreach($data as $k=>$d){
            switch ($d['field_type']){
                case 'input':
                    $data[$k]['newcontent']='<input type="text" name="conf_content[]" class="lg" value="'.$d['conf_content'].'">';
                    break;
                case 'radio':
                    $str='';
                    $tmp=explode(',',$d['field_value']);
                    foreach ($tmp as $kt=>$vt){
                        $tmp2=explode('|',$vt);
                        $check=$tmp2[0]==$d['conf_content']?'checked':'';
                        $str.='<input type="radio" name="conf_content['.$k.']" '.$check.' value="'.$tmp2[0].'">'.$tmp2[1].'　';
                    }
                    $data[$k]['newcontent']=$str;
                    break;
                case 'textarea':
                    $data[$k]['newcontent']='<textarea name="conf_content[]">'.$d['conf_content'].'</textarea>';
                    break;
            }
        }
        return view('admin.config.index',compact('data'));
    }

    public function changeOrder(Request $request)
    {
        $input = $request->all();
        $configs = $this->config->find($input['conf_id']);
        $configs->conf_order = $input['conf_order'];
        $re = $configs->update();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '配置项排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '配置项排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //get.admin/configs/create   添加配置项
    public function create()
    {
        return view('admin/config/add');
    }

    //post.admin/configs  添加配置项提交
    public function store(StoreConfigRequest $request)
    {
        $input = $request->except('_token');
        $re = $this->config->create($input);
        if($re){
            $this->config->putConfig();
            return redirect('admin/config');
        }else{
            return back()->with('errors','配置项失败，请稍后重试！');
        }
    }

    //get.admin/configs/{configs}/edit  编辑配置项
    public function edit($conf_id)
    {
        $field = $this->config->find($conf_id);
        return view('admin.config.edit',compact('field'));
    }

    //put.admin/configs/{configs}    更新配置项
    public function update(StoreConfigRequest $request,$conf_id)
    {
        $input = $request->except('_token','_method');
        $re = $this->config->update($conf_id,$input,'conf_id');
        $this->config->putConfig();
        if($re){
            return redirect('admin/config');
        }else{
            return back()->with('errors','配置项更新失败，请稍后重试！');
        }
    }

    //delete.admin/configs/{configs}   删除配置项
    public function destroy($conf_id)
    {
        $re = $this->config->delete('conf_id',$conf_id);
        $this->config->putConfig();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '配置项删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '配置项删除失败，请稍后重试！',
            ];
        }
        return $data;
    }
    //修改conf_content
    public function updatecontent(Request $request){
        $input=$request->except('_token');
        foreach($input['conf_id'] as $k=>$val){
                $this->config->update($val,['conf_content'=>$input['conf_content'][$k]],'conf_id');
        }
        $this->config->putConfig();
        return back()->with('errors','配置项修改成功！');
    }


}
