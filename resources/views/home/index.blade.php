@extends('layouts.home.public')
  @section('content')
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> <!--banner-->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="item active"> <a href="#" target="_blank"><img src="{{asset('resources/home/images/myimg1.jpg')}}" alt="" style="height:271.625px;width: 730px"/></a>
            <div class="carousel-caption"> {{config('web.welspeak')}}</div>
            <span class="carousel-bg"></span> </div>
          <div class="item"> <a href="#" target="_blank"><img src="{{asset('resources/home/images/img2.jpg')}}" alt=""  /></a>
            <div class="carousel-caption"> {{config('web.welspeak')}} </div>
            <span class="carousel-bg"></span> </div>
          <div class="item"> <a href="#" target="_blank"><img src="{{asset('resources/home/images/img1.jpg')}}" alt="" /></a>
            <div class="carousel-caption"> {{config('web.welspeak')}}</div>
            <span class="carousel-bg"></span> </div>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
      <!--/banner-->
      <div class="content-block hot-content hidden-xs">
        <h2 class="title"><strong>本周热门排行</strong></h2>
        <ul>
            @foreach($ben as $k=>$b)
                <li class="{{$k==0?'large':''}}"><a href="{{url('article/'.$b['art_id'])}}" target="_blank"><img src="{{url($b['art_thumb'])}}" alt="">
                        <h3> {{$b['art_title']}}</h3>
                    </a></li>
            @endforeach

        </ul>
      </div>
      <div class="content-block new-content">
        <h2 class="title"><strong>最新文章</strong></h2>
        <div class="row">
          @foreach($new as $n)
          <div class="news-list" index="{{$n['art_id']}}">
            <div class="news-img col-xs-5 col-sm-5 col-md-4"> <a target="_blank" href="{{url('article/'.$n['art_id'])}}"><img src="{{url($n['art_thumb'])}}" alt=""> </a> </div>
            <div class="news-info col-xs-7 col-sm-7 col-md-8">
              <dl>
                <dt> <a href="{{url('article/'.$n['art_id'])}}" target="_blank" > {{$n['art_title']}} </a> </dt>
                <dd><span class="name"><a href="#" title="由 傲小兮 发布" rel="author">傲小兮</a></span> <span class="identity"></span> <span class="time"> {{$n['art_time']}} </span></dd>
                <dd class="text">{{$n['art_description']}}</dd>
              </dl>
              <div class="news_bot col-sm-7 col-md-8"> <span class="tags visible-lg visible-md"> <a href="{{url('cate/'.$n['cate_id'])}}">{{$n['cate_name']}}</a> </span> <span class="look"> 共 <strong>{{$n['art_view']}}</strong> 人围观 </span> </div>
            </div>
          </div>
        @endforeach
          </div>
        </div>
        <div class="news-more" id="pagination">
        	<a href="javascript:" class="more">查看更多</a>
        </div>
        <!--<div class="quotes" style="margin-top:15px"><span class="disabled">首页</span><span class="disabled">上一页</span><span class="current">1</span><a href="index.html">2</a><a href="index.html">下一页</a><a href="index.html">尾页</a></div>-->

      {{--<div class="quotes" style="margin-top:15px"> {{$new->links()}}</div>--}}
  @endsection
@section('script')
//异步加载更多内容
var page=1;
$('.more').click(function(){
    page++;
    obj=this;
    $.post("{{url('indexMore')}}",{'_token':'{{csrf_token()}}','page':page},function(r){
        if(r!=''){
            $(obj).parent().prev().find('.row').append(r);
        }
        else{
            layer.alert('亲，没有更多了！', {icon: 6});
        }
    });
});
@endsection

