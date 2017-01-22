@extends('layouts.home.public')
@section('content')
      <div class="content-block about-content">
        <h2 class="title"><strong>关于傲小兮</strong></h2>
        <p class="line-title">想要深入了解<span>傲小兮？</span></p>
        <p>傲小兮技术博客的		内容大概为网站前端和后端的技术，包括内容管理系统，文章内容有自己的原创，也有其他博文上转载过来的优秀文章，如果我遇到好的资源会第一时间发布在本博客内。</p>
        <p>大家如果有好的文章好的技术请不要吝啬，欢迎前来投稿！</p>
        <p>如果有什么疑问或者需要投稿的请使用下方联系方式，或者留言来告诉我，收到后第一时间回复。</p>
      </div>
      <div class="content-block contact-content">
        <h2 class="title"><strong>联系傲小兮</strong></h2>
        <p><span>站长QQ：</span><a href="tencent://message/?uin=823820360\">823 820 360</a></p>
        <p><span>交流群：</span><a href="index.html">310685895</a></p>
        <p><span>站长信箱：</span><a href="mailto:admin@ylsat.com">im.zhangyingren@qq.com</a></p>
      </div>
      <div class="content-block comment">
        <h2 class="title"><strong>添加留言</strong></h2>
        <form action="message.php" method="post" class="form-inline" id="comment-form">
          <div class="comment-title">
            <div class="form-group">
              <label for="messageName">姓名：</label>
              <input type="text" name="messageName" class="form-control" id="messageName" placeholder="傲小兮">
            </div>
            <div class="form-group">
              <label for="messageEmail">邮箱：</label>
              <input type="email" name="messageEmail" class="form-control" id="messageEmail" placeholder="im.zhangyingren@qq.com">
            </div>
          </div>
          <div class="comment-form">
            <textarea placeholder="在此处填写留言内容" name="messageContent"></textarea>
            <div class="comment-form-footer">
              <div class="comment-form-text">请先 <a href="javascript:;">登录</a> 或 <a href="javascript:;">注册</a>，也可匿名留言 </div>
              <div class="comment-form-btn">
                <button type="submit" class="btn btn-default btn-comment">提交留言</button>
              </div>
            </div>
          </div>
        </form>
        <div class="content-block comment-content">
          <h2 class="title"><strong>最新留言</strong></h2>
          <ul>
            <li><span class="text"><strong>傲小兮站长</strong> (2016-04-28) 留言：<br />
              欢迎来到傲小兮技术博客，在这里可以看到网站前端和后端的技术等在这里可以看到网站前端和后端的技术等在这里可以看到网站前端和后端的技术等 ...</span></li>
          </ul>
        </div>
      </div>
@endsection
  <!--/内容-->
@section('script')
//异步加载更多内容
jQuery("#pagination a").on("click", function ()
{
    var _url = jQuery(this).attr("href");
    var _text = jQuery(this).text();
    jQuery(this).attr("href", "javascript:viod(0);");
    jQuery.ajax(
    {
        type : "POST",
        url : _url,
        success : function (data)
        {
            //将返回的数据进行处理，挑选出class是news-list的内容块
            result = jQuery(data).find(".row .news-list");
            //newHref获取返回的内容中的下一页的链接地址
            nextHref = jQuery(data).find("#pagination a").attr("href");
            jQuery(this).attr("href", _url);
            if (nextHref != undefined)
            {
                jQuery("#pagination a").attr("href", nextHref);
            }
			else
            {
                jQuery("#pagination a").html("下一页没有了").removeAttr("href")
            }
            // 渐显新内容
            jQuery(function ()
            {
                jQuery(".row").append(result.fadeIn(300));
                jQuery("img").lazyload(
                {
                    effect : "fadeIn"
                });
            });
        }
    });
    return false;
});
@endsection

