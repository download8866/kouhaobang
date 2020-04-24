<link rel="stylesheet" href="/template/modules/font/font.css">
<style>
    header {height: 70px; line-height: 70px;position:fixed;width:100%;top:0;z-index:3;box-shadow: 0 0 5px #e6e6e6;}
    header .logo-img {width:200px;height:100%;text-align:center;}
    header .logo-img img {max-width:100%;max-height:100%;display:inline-block;}
    header .head-nav li {float:left;padding:0 20px;}
    header .head-nav li a {border-bottom: 2px solid #fff;display:block;height: 70px;box-sizing:border-box;font-size:14px;}
    header .head-nav li.active a {border-bottom-color:#333;}
    header .user {position:relative;cursor:pointer;font-size:14px;}
    header .user img {position:absolute;top:17px;}
    header .user em {margin-left:40px;}
    header .user .inner-box{display: none; position:absolute;top:70px;left:-160px;width: 200px;background:#fff;box-shadow: 0 0 5px #e6e6e6;padding: 16px 20px;min-width: 136px;box-shadow: 0 2px 12px 0 #e1e3e6;border: 1px solid #f0f0f0; border-radius: 8px;}
    header .user .inner-box .username{line-height:40px;border-bottom:1px solid #f5f5f5;}
    header .user .inner-box .chargenum{border-bottom: 1px solid #f5f7fa;line-height:1.5;padding-bottom:20px;padding-top:10px;}
    header .user .inner-box .chargenum a{color: #fff;border-radius: 27px;background: #f55779;border: #f55779;font-size: 12px; height: 22px;padding:2px 15px;display:inline-block;vertical-align:middle;text-align:center;}
    header .user:hover .inner-box {display: block;}
    header .user .inner-box .li-a{ display: block;height: 32px;line-height: 32px;}
    header .user .inner-box .li-a:hover{color: #ff6600;}
    .mtop{margin-top:90px;}
    .radius {border-radius:4px;}
</style>

<header class="bgff">
    <div class="wrap clear">
        <div class="logo-img fl">
            <img src="{{$website->logo}}" alt="">
        </div>
        <ul class="fl clear head-nav">
            <li class="@if(strstr($menu, 'member')) active @endif"><a href="/member">我的账户</a></li>
            @if(strstr($my_apply, 'sarticle'))
            <li class="@if(strstr($menu, 'sarticle_order_create')) active @endif"><a href="/member/sarticle">软文发布</a></li>
            @elseif(strstr($my_apply, 'zimeiti'))
            <li><a href="/member/zimeiti">自媒体</a></li>
            @endif
        </ul>
        <div class="fr user">
            <img height="36px" src="/template/member/images/user-av.png" alt="">
            <em></em>
            <div class="inner-box">
                <p class="username">-</p>
                <div class="chargenum clear">
                    <div class="fl" onClick="location.href='/member/finance'"><p class="fontdin a-main fz30 charge-money">0</p><p class="c-999 fz12">余额(元)</p></div>
                    <div class="fr pt5"><a href="/member/finance/pay">充值</a></div>
                </div>
                <a href="/member" class="li-a">我的账户</a>
                <a href="javascript:;" class="li-a logout-btn">退出登录</a>
            </div>
        </div>
        <div class="fr mr20">
            <a href="/member/message">
                <i class="iconfont icon-msg fz20 mr10"></i>
            </a>  
            <!-- <i class="iconfont icon-help fz20"></i> -->
        </div>
    </div>
</header>
<script>
    $(function(){
        getInfo()
        $('.logout-btn').on('click',function(){
            localStorage.removeItem('username');
            location.href = '/member/logout'
        })
    })
    function getInfo() {
        $.post("{{route('home.member.info')}}", {
            '_token':'{{csrf_token()}}'
        }, function (res) {
            if (res.code === 0) {
                localStorage.username = res.data.name
                $('.username').html(res.data.name);
                $('.charge-money').html(res.data.money);
                $('#accountprice').html(res.data.money);
            }
        }).error(function (error) {
            
        });
    }
</script>
@include('home.template.a.right_layout')
