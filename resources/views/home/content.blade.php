@extends('layouts.home.public')
@section('content')
    <style>
        .content .news_content{text-indent: 0em}
    </style>
        <header class="news_header">
            <h2>{{$art['art_title']}}</h2>
            <ul>
                <li>{{$art['art_editor']}} 发布于 {{$art['art_time']}}</li>
                <li>栏目：<a href="#" title="" target="_blank">{{$art['cate_name']}}</a></li>
                <li>来源：<a href="#" title="" target="_blank">自创</a></li>
                <li>共 <strong>{{$art['art_view']}}</strong> 人围观 </li>
            </ul>
        </header>
        <article class="news_content">
            {{--<p><img src="{{url($art['art_thumb'])}}" alt="" title="" /></p>--}}
            <p>{!! $art['editormd-html-code'] !!}</p>

        </article>
        <div class="reprint">{{config('web.zhuanzai')}}<a href="{{url('/')}}" title="" target="_blank">{{config('web.seo_title')}}</a> » <a href="{{url('/')}}" title="" target="_blank">{{config('web.welcome')}}</a></div>
        <div class="zambia"><a href="javascript:;" name="zambia" rel="{{$art['art_id']}}"><span class="glyphicon glyphicon-thumbs-up"></span> 赞（<span class="zan">{{$art['art_zan']}}</span>）</a></div>
        <div class="guanjian tags news_tags">
            关键字：
            <?php
                foreach (explode('，',$art['art_tag']) as $guanjianval){
            ?>
                    <span data-toggle="tooltip" data-placement="bottom"><a href="">{{$guanjianval}}</a></span>
            <?php
                }
            ?>
        </div>
        {{--<div class="tags news_tags">标签： <span data-toggle="tooltip" data-placement="bottom" title="{{config('web.biaoqian2')}}"><a href="{{url('/')}}">本站</a></span> <span data-toggle="tooltip" data-placement="bottom" title="{{config('web.biaoqian1')}}"><a href="{{url('/')}}">傲小兮</a></span> </div>--}}
        <nav class="page-nav">
            <span class="page-nav-prev" style="display: {{isset($preart)?'inline':'none'}}">上一篇<br />
                <a href="{{url('article/'.$preart['art_id'])}}" rel="prev">{{$preart['art_title']}}</a>
            </span>
            <span class="page-nav-next" style="display: {{isset($nextart)?'inline':'none'}}">下一篇<br />
                <a href="{{url('article/'.$nextart['art_id'])}}" rel="next">{{$nextart['art_title']}}</a>
            </span>
        </nav>
        <div class="content-block related-content visible-lg visible-md">
            <h2 class="title"><strong>相关推荐</strong></h2>
            <ul>
                <!--相关推荐8篇-->
                @foreach($tot as $t)
                <li><a target="_blank" href="{{url('article/'.$t['art_id'])}}"><img src="{{url($t['art_thumb'])}}" alt="">
                        <h3>{{$t['art_description']}}</h3>
                    </a></li>
                @endforeach
            </ul>
        </div>
        <div class="content-block comment">
            <h2 class="title"><strong>评论</strong></h2>
            <form action="comment.php" method="post" class="form-inline" id="comment-form">

                <div class="comment-form">
                    <textarea placeholder="" name="commentContent" style="text-align: center; font-size:16px;margin-top:40px ">评论已经关闭</textarea>

                </div>
            </form>
        </div>
@endsection
@section('script')
    //相关推荐
$(document).ready(function() {
$('pre code').each(function(i, block) {
    hljs.highlightBlock(block);
});
});
$(function(){
    $(".related-content ul li").hover(function(){
        $(this).find("h3").show();
    },function(){
        $(this).find("h3").hide();
    });
});
//ajax更新点赞值
$(function(){
    $(".content .zambia a").one('click',function(){
        var zan=parseInt($('.zan').html());
        $('.zan').html(zan+1);
        var art_id=$(this).attr('rel');
        $.post("{{url('zan')}}/"+art_id,{'_token':'{{csrf_token()}}','zan':zan},function(r){
            if(r=='ok'){
                layer.alert('您的支持是我进步最大动力！', {icon: 6});
            }
        });
    });
})
@endsection

