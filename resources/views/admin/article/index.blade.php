@extends('layouts.admin.public')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
</div>
<!--面包屑导航 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_title">
            <h3>文章管理</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">ID</th>
                    <th>标题</th>
                    <th>关键词</th>
                    <th>描述</th>
                    <th>缩略图</th>
                    <th>点击</th>
                    <th>编辑</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td class="tc">{{$v->art_id}}</td>
                    <td>
                        <a href="#">{{$v->art_title}}</a>
                    </td>
                    <td>{{$v->art_tag}}</td>
                    <td>{{$v->art_description}}</td>
                    <td>{{$v->art_thumb}}</td>
                    <td>{{$v->art_view}}</td>
                    <td>{{$v->art_editor}}</td>
                    <td>{{$v->art_time}}</td>
                    <td>
                        <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="delArt({{$v->art_id}})">删除</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</form>
<div class='page'>
    {{$data->links()}}
</div>
<script>
    function delArt(art_id){
        $.post("{{url('admin/article')}}/"+art_id,{'_token':'{{csrf_token()}}','_method':'delete'},function(r){
            if(r.status==1){
                layer.confirm('确定删除吗?亲', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    layer.msg('删除成功', {icon: 6});
                    location=location;
                });
            }
            else{
                layer.alert('删除失败！', {icon: 5});
            }
        });
    }
</script>
@endsection
