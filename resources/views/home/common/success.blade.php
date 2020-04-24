<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>充值回调 - {{ $seo ? $seo->title :'口号帮OEM' }}</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        padding: 0;
        margin: 0;
        font-size: 12px;
        color: #333;
        background: #f0f1f2
    }

    header {
        height: 60px;
        width: 100%;
        background: #fff;
        color: #fff;
    }

    header nav {
        width: 960px;
        margin: 0 auto;
        height: 60px;
        overflow: hidden
    }

    .tdou_wrap {
        width: 960px;
        margin: 15px auto 20px;
        padding-bottom: 50px;
        overflow: hidden;
        background: #fff;
    }

    .messOuter {
        width: 305px;
        margin: 115px auto 0;
    }
    .mess img {
        vertical-align: top;
        width: 40px;
        height: 40px;
    }
    .mess span {
        display: inline-block;
        height: 40px;
        line-height: 40px;
        font-size: 24px;
        color: #666;
        margin-left: 15px;
        font-weight: 700;
    }
    .costMoney {
        display: block;
        font-size: 14px;
        color: #333;
        margin-top: 25px;
    }

    .money-num-color {
        color: #fa7d3e;
    }

    .recharge-info {
        margin-top: 45px;
        font-size: 14px;
        color: #999;
    }

    .recharge-item {
        margin-bottom: 12px;
    }

    .recharge-left {
        display: inline-block;
        width: 70px;
        text-align: right;
    }

    .game-name,
    .game-account,
    .game-time {
        color: #333;
    }
    @media screen and (max-width: 900px) {
        header nav{
            width: 100%;
        }
        .tdou_wrap{
            width: 100%;
        }
    }
</style>

<body>
<div class="wrap1">
    <div class="wrap2">
        <div class="tdou_wrap">
            <div class="messOuter">
                <div class="mess"><img src="http://tb2.bdstatic.com/tb/static-comforum/widget/tdou_success/img/success_1d68c01.png"><span>支付成功</span></div><span
                        class="costMoney">支付成功，金额<span class="money-num-color"></span>{{ isset($info) && isset($info['total_amount'])?$info['total_amount']:'' }}元</span>
                <div class="recharge-info">
                    <div class="recharge-item"><span class="recharge-left">订单号码：</span><span class="game-account">{{ isset($info) && isset($info['out_trade_no'])?$info['out_trade_no']:'' }}</span></div>
                    <div class="recharge-item"><span class="recharge-left">支付时间：</span><span class="game-time">{{ isset($info) && isset($info['timestamp'])?$info['timestamp']:'' }}</span></div>
                    <a class="recharge" href="javascript:;" onclick="redirect()" style="text-decoration: none">点击返回(页面将在<span class="seconds" style="color: red">5</span>秒后自动跳转)</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="/js/jquery.min.js"></script>
<script>
    var count = 5;
    var t;
    function writeTip(){
        $('.seconds').html(count--);
        if(count==0){
            window.clearInterval(t);
            redirect()
        }
    }

    t = window.setInterval("writeTip()",1000);

    function redirect() {
        var width_ = $(window).width()
        var url_ = '/index.html'
        if (width_ < 769) {
            window.location.href = url_
        }else{
            window.location.href = '/member/finance'
        }
    }
    /*    $(function(){
     setTimeout(function(){
     redirect()
     },5000)
     })*/
</script>
</html>