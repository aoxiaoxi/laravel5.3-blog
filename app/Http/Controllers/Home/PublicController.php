<?php

namespace App\Http\Controllers\Home;


use App\Repositories\Eloquent\ArticleRepositories;
use App\Repositories\Eloquent\CategoryRepositories;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class PublicController extends Controller
{
    protected $category;
    protected $article;
    public function __construct(
        CategoryRepositories $categoryRepository,
        ArticleRepositories $articleRepository)
    {
        $this->category=$categoryRepository;
        $this->article=$articleRepository;
        //获取点击量较高的文章（点击排行）
        $hot=$this->article->viewMostArt();

        //获取当前时间
        $time=date('Y年m月d日',time());
        //获取星期几
        $week=date('N', time());
        switch($week){
            case 1;
                $newweek="星期一";
                $every="希望再过几年真的被喊叔叔的年纪，那时候回头感谢一下现在选择拼搏的我。";
                break;
            case 2;
                $newweek="星期二";
                $every="成功就是每天进步一点点。";
                break;
            case 3;
                $newweek="星期三";
                $every="为别人鼓掌的人也是在给自己的生命加油。";
                break;
            case 4;
                $newweek="星期四";
                $every="勤奋刻苦，主动地寻找困难，解决困难，比别人多想一步，多做一步，往往这一步就能迈向成功。";
                break;
            case 5;
                $newweek="星期五";
                $every="将代码，编成诗；用BUG，描绘完美的样子。我是诗人，也是摄影师。";
                break;
            case 6;
                $newweek="星期六";
                $every="没有天分，就用时间去换......。";
                break;
            case 7;
                $newweek="星期日";
                $every="总结自己一周做的好的地方，继续努力，不好的地方努力改正。准备好迎接更加美好的一周。";
                break;
        }
        //获取左侧导航的类目
        $class=$this->category->onelevelCate();
        View::share(['hot'=>$hot,'time'=>$time,'week'=>$newweek,'every'=>$every,'class'=>$class]);
    }
}
