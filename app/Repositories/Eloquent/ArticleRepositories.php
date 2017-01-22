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
    private $pageSize;
    public function __construct(Article $article)
    {
        $this->pageSize=3;
        $this->model=$article;
    }

    public function all(){
        $data=$this->model->orderBy('art_id','desc')->paginate(6);
        return $data;

    }

    public function hotArt(){
        $hotArts = $this->model->where('art_time','>=',strtotime('-7days'))
            ->orderBy('art_time','desc')
            ->take(5)
            ->get();
        return $hotArts;
    }

    public function newArt(){
        $newArts = $this->model->orderBy('art_time','desc')
            ->join('blog_category','blog_category.cate_id','=','blog_article.cate_pid')
            ->offset(0)
            ->limit($this->pageSize)
            ->get();
        return $newArts;
    }

    public function viewMostArt(){
        $viewMostArts=$this->model->orderBy('art_view','desc')->take(5)->get()->toArray();
        return $viewMostArts;
    }

    public function getArtOfCate($cate_id){
        $arts = $this->model->where('cate_pid',$cate_id)->orderBy('art_time','desc')
            ->offset(0)
            ->limit($this->pageSize)
            ->get()
            ->toArray();
        return $arts;
    }

    public function getArtInfo($art_id){
        $artInfo = $this->model->where('blog_article.art_id',$art_id)
            ->join('blog_category','blog_article.cate_pid','=','blog_category.cate_id')
            ->first()
            ->toArray();
        return $artInfo;
    }

    public function art_view_increment($attribute,$value){
        $views = $this->model->where($attribute,$value)->increment('art_view');
        return $views;
    }

    public function getPreArt($attribute,$value){
        $preart=$this->model->orderBy('art_id','desc')->where($attribute,'<',$value)->first();
        return $preart;
    }

    public function getNextArt($attribute,$value){
        $nextart=$this->model->orderBy('art_id','asc')->where($attribute,'>',$value)->first();
        return $nextart;
    }

    //同一类目下的相关推荐8篇
    public function getOtherArt($attribute,$value){
        $pid=$this->model->where($attribute,$value)->value('cate_pid');
        $tot=$this->model->where('cate_pid',$pid)->where($attribute,'!=',$value)->take(8)->get()->toArray();
        return $tot;
    }

    //首页最新文章查看更多
    public function indexMore($page){
        $more=$this->model->orderBy('art_time','desc')
            ->join('blog_category','blog_category.cate_id','=','blog_article.cate_pid')
            ->offset(($page-1)*$this->pageSize)
            ->limit($this->pageSize)
            ->get()
            ->toArray();
        //加载更多信息
        $str='';
        foreach($more as $m){
            $str.="
          <div class='news-list' index='{$m['art_id']}'>
            <div class='news-img col-xs-5 col-sm-5 col-md-4'> <a target='_blank' href='".url('article/'.$m['art_id'])."'><img src='".url($m['art_thumb'])."' alt=''> </a> </div>
            <div class='news-info col-xs-7 col-sm-7 col-md-8'>
              <dl>
                <dt> <a href=".url('article/'.$m['art_id'])." target='_blank' > 
            $m[art_title]</a> </dt>
                <dd><span class='name'><a href='#' title='由 傲小兮 发布' rel='author'>傲小兮</a></span> <span class='identity'></span> <span class='time'> 
            $m[art_time]</span></dd>
                <dd class='text'>
            $m[art_description]</dd>
              </dl>
              <div class='news_bot col-sm-7 col-md-8'> <span class='tags visible-lg visible-md'> <a href='".url('/')."'>本站</a> <a href='#'>傲小兮</a> </span> <span class='look'> 共 <strong>
            $m[art_view]</strong> 人围观 </span> </div>
            </div>
          </div>";
        }
        return  $str;
    }

    //各个分类下文章查看更多
    public function cateMore($pindex,$page){
        $more=$this->model->where('cate_pid',$pindex)
            ->orderBy('art_time','desc')
            ->offset(($page-1)*$this->pageSize)
            ->limit($this->pageSize)
            ->get()
            ->toArray();
        //加载更多信息
        $str='';
        foreach($more as $m){
            $str.="
          <div class='news-list'  pindex='{$m['cate_pid']}' index='{$m['art_id']}'>
            <div class='news-img col-xs-5 col-sm-5 col-md-4'> <a target='_blank' href='".url('article/'.$m['art_id'])."'><img src='".url($m['art_thumb'])."' alt=''> </a> </div>
            <div class='news-info col-xs-7 col-sm-7 col-md-8'>
              <dl>
                <dt> <a href=".url('article/'.$m['art_id'])." target='_blank' > 
            $m[art_title]</a> </dt>
                <dd><span class='name'><a href='#' title='由 傲小兮 发布' rel='author'>傲小兮</a></span> <span class='identity'></span> <span class='time'> 
            $m[art_time]</span></dd>
                <dd class='text'>
            $m[art_description]</dd>
              </dl>
              <div class='news_bot col-sm-7 col-md-8'> <span class='tags visible-lg visible-md'> <a href='".url('/')."'>本站</a> <a href='#'>傲小兮</a> </span> <span class='look'> 共 <strong>
            $m[art_view]</strong> 人围观 </span> </div>
            </div>
          </div>";
        }
        return $str;
    }

    public function updateZan($art_id,$art_zan){
        $res=$this->model->where('art_id',$art_id)->update(['art_zan'=>$art_zan]);
        return $res;
    }

    public function sou($guanjian){
        $result=$this->model->where('art_tag','like','%'.$guanjian.'%')
            ->join('blog_category','blog_category.cate_id','=','blog_article.cate_pid')->paginate(6);
        return $result;
    }
}