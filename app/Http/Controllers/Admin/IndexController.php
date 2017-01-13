<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class IndexController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function info(){
        return view('admin.info');
    }
    public function pass(Request $request){
        $password=$request->password_o;
        $new_password=$request->password;
        if($input=$request->all()){
            $rules=[
                'password'=>'required|between:6,20|confirmed',
                'email'=>'email'
            ];
            $message=[
                'password.required'=>'请输入新密码!',
                'password.between'=>'密码格式不正确',
                'password.confirmed'=>'两次密码不一致',
                'email.email'=>'邮箱格式不正确',
            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $user = Auth::user();
                if (Auth::attempt(['email' => $user->email, 'password' => $password])) {
                    $user->password=bcrypt($new_password);
                    $res = $user->save();
                    if($res){
                        return back()->withErrors('修改成功！');
                    }
                }
                else{
                    return back()->withInput()->withErrors('原密码错误');
                    //return back()->with('errors','原密码错误');
                }
            }
            else{
                return back()->withInput()->withErrors($validator);
            }
        }
        else{
            return view('admin.pass');
        }

    }
}
