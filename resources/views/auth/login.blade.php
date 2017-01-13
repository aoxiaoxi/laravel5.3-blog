<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('resources/admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('resources/admin/style/font/css/font-awesome.min.css')}}">
    <style>
        img:hover{
            cursor: pointer;
        }
    </style>
</head>
<body style="background:#F3F3F4;">
<div class="login_box">
    <h1>Blog</h1>
    <h2>欢迎使用博客管理平台</h2>
    <div class="form">
        <p style="color:red">

        </p>
        <p style="color:red">

        </p>
        <p style="color:red">

        </p>

        <form action="{{url('/login')}}" method="post">
            {{csrf_field()}}
            <ul>
                <li>
                    <input type="text" name="{{config('admin.global.login_field')}}" class="text" value="{{old(config('admin.global.login_field'))}}"/>
                    <span><i class="fa fa-user"></i></span>
                    @if ($errors->has(config('admin.global.login_field')))
                        <b style="color:red">{{ $errors->first(config('admin.global.login_field')) }}</b>
                    @endif
                </li>
                <li>
                    <input type="password" name="password" class="text" value="{{old('password')}}"/>
                    <span><i class="fa fa-lock"></i></span>
                    @if ($errors->has('password'))
                        <b style="color:red">{{ $errors->first('password') }}</b>
                    @endif
                </li>
                <li>
                    <input type="text" class="code" name="code"/>
                    <span><i class="fa fa-check-square-o"></i></span>
                    <img src="{{captcha_src()}}" alt="" onclick="this.src='{{captcha_src()}}?'+Math.random()">
                    @if ($errors->has('code'))
                        <b style="color:red">{{ $errors->first('code') }}</b>
                    @endif
                </li>
                <li>
                    <input type="submit" value="立即登陆"/>
                </li>
            </ul>
        </form>
        <p><a href="#">返回首页</a>
    </div>
</div>
</body>
</html>