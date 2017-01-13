@extends('layouts.admin.public')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>文章管理</h3>
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
            <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
            <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>

        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/article')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120">分类：</th>
                <td>
                    <select name="cate_pid">
                        <option value="0">==顶级分类==</option>
                        @foreach($data as $d)
                            <option value="{{$d['cate_id']}}">{{$d['cate_name']}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>文章标题：</th>
                <td>
                    <input type="text" class="lg" name="art_title" value="{{old('art_title')}}">
                </td>
            </tr>
            <tr>

                <th>关键词描述：</th>
                <td>
                    <input type="text" class="lg" name="art_tag" value="{{old('art_tag')}}">
                </td>
            </tr>
            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="art_description">{{old('art_description')}}</textarea>
                </td>
            </tr>

            <tr>
                <th>缩略图：</th>
                <td>
                    <input type="text" size="50" name="art_thumb"  value="{{old('art_thumb')}}" >
                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                    <script src="{{asset('resources/common/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                    <link rel="stylesheet" type="text/css" href="{{asset('resources/common/uploadify/uploadify.css')}}">
                    <style>
                        .uploadify{display:inline-block;}
                        .uploadify-button{border:5px; border-radius:35px; margin-top:8px;}
                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                    </style>
                    <script type="text/javascript">
                        <?php $timestamp = time();?>
                        $(function() {
                            $('#file_upload').uploadify({
                                'buttonText' : '图片上传',
                                'formData'     : {
                                    'timestamp' : '<?php echo $timestamp;?>',
                                    '_token'     : '{{csrf_token()}}'
                                },
                                'swf'      : '{{asset('resources/common/uploadify/uploadify.swf')}}',
                                'uploader' : '{{url('admin/upload')}}',
                                'onUploadSuccess' : function(file, data, response) {
                                    $('input[name=art_thumb]').val(data);
                                    //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
                                    $('#art_thumb').attr({'src':'http://'+data});
                                }
                            });
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <img src="{{'http://'.old('art_thumb')}}" alt="" id="art_thumb" style="max-width: 300px;max-height: 100px">
                </td>
            </tr>


            <tr>
                <th>文章内容：</th>
                <td >
                    <style>
                        .CodeMirror{
                            height:600px!important;
                        }
                    </style>
                    <div id="editormd">
                        <textarea style="display:none;" >{!! old('editormd-markdown-doc') !!}</textarea>
                    </div>
                    <link rel="stylesheet" href="{{asset('resources/common/editor/css/editormd.min.css')}}" />
                    <script src="{{asset('resources/common/editor/editormd.min.js')}}"></script>
                    <script type="text/javascript">
                        $(function() {
                            var editor = editormd({
                                id   : "editormd",
                                width   : "100%",
                                height  : 640,
                                syncScrolling : "single",
                                toolbarAutoFixed: false,
                                gotoLine:false,
                                emoji:true,
                                saveHTMLToTextarea:true,
                                path : "/resources/common/editor/lib/",
                                imageUpload : true,
                                imageUploadURL : '/resources/uploads'
                            });
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <th>编辑：</th>
                <td>
                    <input type="text" class="sm" name="art_editor" value="{{old('art_editor')}}">
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

@endsection
