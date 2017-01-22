@extends('layouts.home.public')
  @section('content')
      <!--/banner-->
      <div class="content-block new-content">
        <h2 class="title">
            <strong>搜索结果</strong>
            <span style="font-size: 12px; color: #777; margin-left: 10px;">(共 {{$num}} 条符合搜索条件的数据)</span>
        </h2>
        <div class="row">
          @foreach($info as $a)
          <div class="news-list" pindex="{{$a['cate_pid']}}" index="{{$a['art_id']}}">
            <div class="news-img col-xs-5 col-sm-5 col-md-4"> <a target="_blank" href="{{url('article/'.$a['art_id'])}}"><img src="{{url($a['art_thumb'])}}" alt=""> </a> </div>
            <div class="news-info col-xs-7 col-sm-7 col-md-8">
              <dl>
                <dt> <a href="{{url('article/'.$a['art_id'])}}" target="_blank" > {{$a['art_title']}} </a> </dt>
                <dd><span class="name"><a href="index.html" title="由 傲小兮 发布" rel="author">傲小兮</a></span> <span class="identity"></span> <span class="time"> {{$a['art_time']}} </span></dd>
                <dd class="text">{{$a['art_description']}}</dd>
              </dl>
              <div class="news_bot col-sm-7 col-md-8"> <span class="tags visible-lg visible-md">  <a href="{{url('cate/'.$a['cate_pid'])}}">{{$a['cate_name'] }}</a> </span> <span class="look"> 共 <strong>{{$a['art_view']}}</strong> 人围观 </span> </div>
            </div>
          </div>
        @endforeach
          </div>
        </div>
        <div class="news-more" id="pagination">
        	<a href="javascript:" class="more">查看更多</a>
        </div>
        <!--<div class="quotes" style="margin-top:15px"><span class="disabled">首页</span><span class="disabled">上一页</span><span class="current">1</span><a href="index.html">2</a><a href="index.html">下一页</a><a href="index.html">尾页</a></div>-->

      <div class="quotes" style="margin-top:15px"> {{$info->links()}}</div>
  @endsection
@section('script')
//异步加载更多内容
$('.more').click(function(){
obj=this;
var index=$(this).parent().prev().find('.news-list').last().attr('index');
var pindex=$(this).parent().prev().find('.news-list').last().attr('pindex');
$.post("{{url('cateMore')}}/"+pindex+"/"+index,{'_token':'{{csrf_token()}}','pindex':'pindex','index':'index'},function(r){
    if(r!=''){
    $(obj).parent().prev().find('.row').append(r);
    }
    else{
    layer.alert('亲，没有更多了！', {icon: 6});
    }
});
});
@endsection

