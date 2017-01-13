@extends('layouts.admin.public')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 分类管理
</div>
<!--面包屑导航 结束-->

{{--<!--结果页快捷搜索框 开始-->--}}
{{--<div class="search_wrap">--}}
    {{--<form action="" method="post">--}}
        {{--<table class="search_tab">--}}
            {{--<tr>--}}
                {{--<th width="120">选择分类:</th>--}}
                {{--<td>--}}
                    {{--<select onchange="javascript:location.href=this.value;">--}}
                        {{--<option value="">全部</option>--}}
                        {{--<option value="http://www.baidu.com">百度</option>--}}
                        {{--<option value="http://www.sina.com">新浪</option>--}}
                    {{--</select>--}}
                {{--</td>--}}
                {{--<th width="70">关键字:</th>--}}
                {{--<td><input type="text" name="keywords" placeholder="关键字"></td>--}}
                {{--<td><input type="submit" name="sub" value="查询"></td>--}}
            {{--</tr>--}}
        {{--</table>--}}
    {{--</form>--}}
{{--</div>--}}
{{--<!--结果页快捷搜索框 结束-->--}}

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_title">
            <h3>分类列表</h3>
        </div>
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
                <a href="{{url('admin/category/index')}}"><i class="fa fa-recycle"></i>全部分类</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th class="tc" width="5%">ID</th>
                    <th>分类名称</th>
                    <th>标题</th>
                    <th>关键字</th>
                    <th>描述</th>
                    <th>查看次数</th>
                    <th>操作</th>
                </tr>

                @inject('cate','App\Repositories\Presenter\CatePresenter')
                {!! $cate->getCate($cates) !!}

            </table>

        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->

<script>
    function changeOrder(obj,cate_id){
        var cate_order = $(obj).val();
        alert(cate_order);
        $.post("{{url('admin/category/changeorder')}}",{'_token':'{{csrf_token()}}','cate_id':cate_id,'cate_order':cate_order},function(data){
            alert(data);
//            if(data.status == 1){
//                layer.msg(data.msg, {icon: 6});
//            }else{
//                layer.msg(data.msg, {icon: 5});
//            }
        });
    }

    //删除分类
    function delCate(cate_id) {
        layer.confirm('您确定要删除这个分类吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/category/delete')}}",{'cate_id':cate_id,'_token':"{{csrf_token()}}"},function (r) {
                if(r.status==1){
                    location.href = location;
                    layer.msg(r.msg, {icon: 6});
                }else{
                    layer.msg(r.msg, {icon: 5});
                }
            });
//            layer.msg('的确很重要', {icon: 1});
        }, function(){

        });
    }



</script>

@endsection
