<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Eloquent\ArticleRepositories;
use Illuminate\Http\Request;

class IndexController extends PublicController
{

    public function index(){
        //本周热门排行
        $ben=$this->article->hotArt();
        //最新发布文章6篇
        $new=$this->article->newArt();
        return view('home.index',compact('ben','new'));
    }
    //列表
    public function cate($cate_id){
        //类目名字
        $name=$this->category->getCateName('cate_id',$cate_id,'cate_name');
        //类目下的文章
        $arts=$this->article->getArtOfCate($cate_id);
        return view('home.cate',compact('name','arts'));
    }

    //文章
    public function art($art_id){
        //当前文章
        $art=$this->article->getArtInfo($art_id);
        //查看次数自增
        $this->article->art_view_increment('art_id',$art_id);
        //上一篇
        $preart=$this->article->getPreArt('art_id',$art_id);
        // 下一篇
        $nextart=$this->article->getNextArt('art_id',$art_id);
        //同一类目下的相关推荐8篇
        $tot=$this->article->getOtherArt('art_id',$art_id);
        return view('home.content',compact('art','preart','nextart','tot'));

    }

    //首页最新文章查看更多
    public function indexMore(Request $request){
        $page=$request->page;
        $str=$this->article->indexMore($page);
        echo $str;
    }

    //各个分类下文章查看更多
    public function cateMore(Request $request){
        $page=$request->page;
        $pindex=$request->pindex;
        $str=$this->article->cateMore($pindex,$page);
        echo $str;
    }
    public function about(){
        return view('home.about');
    }
    //文章点赞
    public function zan($art_id){
        $art_zan=$_POST['zan']+1;
        if($this->article->updateZan($art_id,$art_zan)){
            echo 'ok';
        }
    }
    //关键字搜索
    public function sou(Request $request){
        $guanjian=$request->sou;
        $info=$this->article->sou($guanjian);
        $num=$info->total();
        return view('home.sou',compact('info','num'));
    }
}
