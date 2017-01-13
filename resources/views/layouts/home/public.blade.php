<!doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>傲小兮个人博客</title>
    <link href="{{asset('resources/home/css/bootstrap.min.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('resources/home/css/style.css')}}" type="text/css" rel="stylesheet">
    <link type="text/css" href="{{asset('resources/home/css/nprogress.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('resources/common/highlight/styles/monokai-sublime.css')}}">
    <!--[if lt IE 9]>
    <script src="{{asset('resources/home/js/modernizr.js')}}"></script>
    <script src="{{asset('resources/home/js/html5shiv.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/home/js/respond.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/home/js/selectivizr-min.js')}}" type="text/javascript"></script>
    <![endif]-->
    <link rel="apple-touch-icon-precomposed" href="{{asset('resources/home/images/icon/icon.png')}}">
    <link rel="shortcut icon" href="{{asset('resources/home/images/icon/favicon.ico')}}">
    <meta name="Keywords" content="" />
    <meta name="description" content="" />
    <script type="text/javascript">
        //判断浏览器是否支持HTML5
        window.onload = function() {
            if (!window.applicationCache) {
                window.location.href="ie.html";
            }
        }
    </script>
    <style>
        ::selection { background:#fb742a; color:#FFFFFF}
    </style>
</head>
<body >
<section class="container user-select">
    <header>
        <div class="hidden-xs header"><!--超小屏幕不显示-->
            <h1 class="logo"> <a href="{{url('/')}}" title="傲小兮博客"></a> </h1>
            <ul class="nav hidden-xs-nav">
                <li class="active"><a href="{{url('/')}}"><span class=" glyphicon glyphicon-home"></span>网站首页</a></li>
                @foreach($class as $c)
                <li class="active"><a href="{{url('cate/'.$c['cate_id'])}}"><span class="{{$c['class']}}"></span>{{$c['cate_name']}}</a></li>
                @endforeach
                <li class="active"><a href="{{url('about')}}"><span class="glyphicon glyphicon-user"></span>关于我们</a></li>
            </ul>
            <div class="feeds">
                <a class="feed feed-xlweibo" data-toggle="popover" data-trigger="hover" title="微博扫一扫" data-html="true" data-content="<img src='{{asset('resources/home/images/weibo.png')}}' alt=''>"  href="javascript:;" target="_blank"><i></i>新浪微博</a>
                <a class="feed feed-txweibo" data-toggle="popover" data-trigger="hover" title="QQ扫一扫" data-html="true" data-content="<img src='{{asset('resources/home/images/qq.jpg')}}' alt=''>"  href="javascript:;" target="_blank"><i></i>腾讯QQ</a>
                <a class="feed feed-rss" href="/" target="_blank"><i></i>订阅本站</a> <a class="feed feed-weixin" data-toggle="popover" data-trigger="hover" title="微信扫一扫" data-html="true" data-content="<img src='{{asset('resources/home/images/weixin.png')}}' alt=''>"  href="javascript:;" target="_blank"><i></i>关注微信</a> </div>
        <!--/超小屏幕不显示-->
        <div class="visible-xs header-xs"><!--超小屏幕可见-->
            <div class="navbar-header header-xs-logo">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-xs-menu" aria-expanded="false" aria-controls="navbar"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
            </div>
            <div id="header-xs-menu" class="navbar-collapse collapse">
                <ul class="nav navbar-nav header-xs-nav">
                    @foreach($class as $c)
                        <li class="active"><a href="{{url('cate/'.$c['cate_id'])}}"><span class="{{$c['class']}}"></span>{{$c['cate_name']}}</a></li>
                    @endforeach
                        <li class="active"><a href=""><span class="glyphicon glyphicon-user"></span>关于我们</a></li>
                </ul>
                <form class="navbar-form" action="search.php" method="post" style="padding:0 25px;">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="请输入关键字">
            <span class="input-group-btn">
            <button class="btn btn-default btn-search" type="submit">搜索</button>
            </span> </div>
                </form>
            </div>
        </div>
    </header>
    <div class="content-wrap"><!--内容-->
        <div class="content">
        @yield('content')
        </div>
    </div>
    <aside class="sidebar visible-lg"><!--右侧>992px显示-->
        <div class="sentence"> <strong>每日一句</strong>
            <h2>{{$time}} {{$week}}</h2>
            <p>{{$every}}</p>
        </div>
        <div id="search" class="sidebar-block search" role="search">
            <h2 class="title"><strong>搜索</strong></h2>
            <form class="navbar-form" action="{{url('search')}}" method="post">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" class="form-control" size="35" placeholder="请输入关键字" name="sou">
          <span class="input-group-btn">
          <button class="btn btn-default btn-search" type="submit">搜索</button>
          </span> </div>
            </form>
        </div>
        <div class="sidebar-block recommend">
            <h2 class="title"><strong>热门推荐</strong></h2>
            <ul>
                @foreach($hot as $h)
                <li><a target="_blank" href="{{url('article/'.$h['art_id'])}}"> <span class="thumb"><img src="{{url($h['art_thumb'])}}" alt=""></span> <span class="text"></span> {{$h['art_description']}}<span class="text-muted">阅读({{$h['art_view']}})</span></a></li>
                @endforeach
            </ul>
        </div>
        <div class="sidebar-block comment">
            <h2 class="title"><strong>最新评论</strong></h2>
            <ul>
                <li data-toggle="tooltip" data-placement="top" title="站长的评论"><a target="_blank" href="{{url('/')}}"><span class="face"><img src="{{asset('resources/home/images/mylogo.jpg')}}" alt=""></span> <span class="text"><strong>小兮站长</strong> (2016-04-18) 说：<br />
          欢迎来到傲小兮技术博客，在这里可以看到网站前端和后端的技术等 ...</span></a></li>
            </ul>
        </div>
    </aside>
    <footer class="footer">POWERED BY &copy;<a href="{{config('web.www')}}">傲小兮 </a> ALL RIGHTS RESERVED &nbsp;&nbsp;&nbsp;<span><a href="{{config('web.alibeian')}}" target="_blank">{{config('web.beian')}}</a></span> <span style="display:none"><a href="index.html">网站统计</a></span> </footer>
</section>
<div><a href="javascript:;" class="gotop" style="display:none;"></a></div>
<!--/返回顶部-->
<script src="{{asset('resources/home/js/jquery-2.1.4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/home/js/nprogress.js')}}" type="text/javascript" ></script>
<script src="{{asset('resources/home/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/common/highlight/highlight.pack.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/common/layer/layer.js')}}"></script>
<script type="text/javascript">
    //页面加载
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
    //返回顶部按钮
    $(function(){
        $(window).scroll(function(){
            if($(window).scrollTop()>100){
                $(".gotop").fadeIn();
            }
            else{
                $(".gotop").hide();
            }
        });
        $(".gotop").click(function(){
            $('html,body').animate({'scrollTop':0},500);
        });
    });
    //提示插件启用
    $(function () {
        $('[data-toggle="popover"]').popover();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    //鼠标滑过显示 滑离隐藏
    //banner
    $(function(){
        $(".carousel").hover(function(){
            $(this).find(".carousel-control").show();
        },function(){
            $(this).find(".carousel-control").hide();
        });
    });
    @yield('script')
    //本周热门
    $(function(){
        $(".hot-content ul li").hover(function(){
            $(this).find("h3").show();
        },function(){
            $(this).find("h3").hide();
        });
    });

    //页面元素智能定位
    $.fn.smartFloat = function() {
        var position = function(element) {
            var top = element.position().top; //当前元素对象element距离浏览器上边缘的距离
            var pos = element.css("position"); //当前元素距离页面document顶部的距离
            $(window).scroll(function() { //侦听滚动时
                var scrolls = $(this).scrollTop();
                if (scrolls > top) { //如果滚动到页面超出了当前元素element的相对页面顶部的高度
                    if (window.XMLHttpRequest) { //如果不是ie6
                        element.css({ //设置css
                            position: "fixed", //固定定位,即不再跟随滚动
                            top: 0 //距离页面顶部为0
                        }).addClass("shadow"); //加上阴影样式.shadow
                    } else { //如果是ie6
                        element.css({
                            top: scrolls  //与页面顶部距离
                        });
                    }
                }else {
                    element.css({ //如果当前元素element未滚动到浏览器上边缘，则使用默认样式
                        position: pos,
                        top: top
                    }).removeClass("shadow");//移除阴影样式.shadow
                }
            });
        };
        return $(this).each(function() {
            position($(this));
        });
    };
    //启用页面元素智能定位
    $(function(){
        $("#search").smartFloat();
    });

</script>
</body>
</html>
