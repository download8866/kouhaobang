<style>
    header {height: 80px;background-color: #ffffff; box-shadow: 0 2px 10px 0 rgba(185, 19, 26, 0.1);text-align: center;}
    header .w1200 {height: 80px;}
    .logo {float: left; width: 263px;height: 80px;overflow: hidden;margin-top: 10px;}
    .logo a {display: inline-block; width: 100%; height: 100%;}
    .logo h1 { color: transparent;  text-indent: -9999px; }
    .nav {font-size: 18px;display: inline-block; float: left;}
    .nav li {float: left; margin: 0 10px;line-height: 80px;}
    .nav a {display: inline-block;height: 30px;line-height: 30px; color: #928080;position: relative;}
    .nav a:after { display: none;content: '___';position: absolute;line-height: normal;bottom: -6px;left: calc(50% - 12px);color: #d73e3e;}
    .nav li:hover a, .nav li.active a {color: #d73e3e;}
    .nav li.active a:after {display: block;}
    .login-box {float: right;line-height: 80px;}
    .login-box a {display: inline-block;vertical-align: middle;padding: 0 12px;height: 30px;line-height: 30px;}
    .login-box .login-box-btn {background: #d73e3e; border: 1px solid #d73e3e;color: #fff;border-radius: 2px; }
    .login-box .login-box-btn-o {color: #d73e3e;border: 1px solid #d73e3e;border-radius: 2px;}
    .login-box .login-box-btn-o:hover {background: #d73e3e;color: #fff;}
</style>
<header>
    <div class="wrap clear">
        <div class="logo" style="background:url({{$website->logo}}) center center no-repeat;
                background-size: contain;
                    height: 60px">
        </div>
        <ul class="nav clear" id="menu">
            <li class="@if(strstr($menu, 'index')) active @endif" data-val="index"><a href="/">首页</a></li>
            @if(strstr($apply, 'sarticle'))
            <li class="@if(strstr($menu, 'before_sarticle')) active @endif" data-val="article"><a href="/sarticle">软文</a></li>
            @elseif(strstr($apply, 'zimeiti'))
            <li class="@if(strstr($menu, 'before_zimeiti')) active @endif" data-val="zimeiti"><a href="/zimeiti">自媒体</a></li>
            @endif
            <li class="@if(strstr($menu, 'news')) active @endif" data-val="news"><a href="/new">新闻资讯</a></li>
            <li class="@if(strstr($menu, 'about')) active @endif" data-val="about"><a href="/about/us">关于我们</a></li>
        </ul>
        <div class="login-box login-box1" style="display:none;">
            <a href="/member/register">注册</a>
            <a class="login-box-btn" href="/member/login">登录</a>
        </div>
        <div class="login-box login-box2" style="display:none;">
            <a class="login-box-btn" href="/member">进入平台</a>
            <a class="login-box-btn logout-btn" href="javascript:;" style="background:#e4804d;border-color:#e4804d;">退出</a>
        </div>
    </div>
    <script>
        $(function () {
            if (localStorage.username) {
                $('.login-box1').hide().siblings('.login-box2').show();
            } else {
                $('.login-box2').hide().siblings('.login-box1').show();
            }
            $('.logout-btn').on('click',function(){
                localStorage.removeItem('username');
                location.href = '/member/logout'
            })
        })
    </script>
</header>
@include('home.template.a.right_layout')
