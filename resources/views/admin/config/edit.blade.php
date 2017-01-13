@extends('layouts.admin.public')
@section('content')
        <!--面包屑配置项 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 配置项管理
</div>
<!--面包屑配置项 结束-->

<!--结果集标题与配置项组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>修改配置项</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置项</a>
            <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部配置项</a>
        </div>
    </div>
</div>
<!--结果集标题与配置项组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/config/'.$field->conf_id)}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>标题：</th>
                <td>
                    <input type="text" name="conf_title" value="{{old('conf_title')??$field->conf_title}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>配置项标题必须填写</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>名称：</th>
                <td>
                    <input type="text" name="conf_name" value="{{old('conf_name')??$field->conf_name}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>配置项名称必须填写</span>
                </td>
            </tr>
            <tr>
                <th>类型：</th>
                <td>
                    <input type="radio" class="sm" name="field_type" onclick="showTR()" @if((old('field_type')??$field->field_type)=='input') checked @endif value="input">input　
                    <input type="radio" class="sm" name="field_type" onclick="showTR()" @if((old('field_type')??$field->field_type)=='textarea') checked @endif value="textarea">textarea　
                    <input type="radio" class="sm" name="field_type" onclick="showTR()" @if((old('field_type')??$field->field_type)=='radio') checked @endif value="radio">radio
                </td>
            </tr>
            <tr class="TR">
                <th>类型值：</th>
                <td>
                    <input type="text" class="lg" name="field_value" value="{{old('field_value')??$field->field_value}}">
                    <p><i class="fa fa-exclamation-circle yellow"></i>类型值只有在radio的情况下才需要配置，格式 1|开启,0|关闭</p>
                </td>
            </tr>
            <tr>
                <th>内容：</th>
                <td>
                    <textarea name="conf_content" id="" cols="30" rows="10">{{old('conf_content')??$field->conf_content}}</textarea>
                </td>
            </tr>
            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" class="sm" name="conf_order" value="{{old('conf_order')??$field->conf_order}}">
                </td>
            </tr>
            <tr>
                <th>说明：</th>
                <td>
                    <textarea name="conf_tips" id="" cols="30" rows="10" >{{old('conf_tips')??$field->conf_tips}}</textarea>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<script>
    showTR();
    function showTR(){
        var val=$('input[name=field_type]:checked').val();
        if(val=='radio'){
            $('.TR').show();
        }
        else{
            $('.TR').hide();
        }
    }
</script>
@endsection
