<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;


class PublicController extends Controller
{
    //图片上传
    public function upload(Request $request){
        $file = $request->file('Filedata');
        if($file->isValid()){
            $extension=$file->getClientOriginalExtension();
            $newName    = 'blog_'.date('Ymdhis').'_'.mt_rand(10000,99999).'.'.$extension;

            $accessKey = config('qiniu.accessKey');
            $secretKey = config('qiniu.secretKey');

            $auth = new Auth($accessKey, $secretKey);
            $token = $auth->uploadToken('aoxiaoxi');
            $upManager = new UploadManager();

            $res = $upManager->putFile($token,$newName, $file->getRealPath());
            
            $newUrl=config('qiniu.url').'/'.$res[0]['key'];
            return $newUrl;

        }


    }
}
