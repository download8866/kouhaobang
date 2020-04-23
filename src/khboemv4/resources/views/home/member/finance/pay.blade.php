<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>支付-{{$website->company}}</title>
    <link rel="stylesheet" href="/template/modules/css/icon.css">
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>
    <style>
       .sv-buy-card .item {
            width: 150px;
            height: 90px;
            border: 1px solid rgb(221, 221, 221);
            border-radius: 4px;
            background: #fff;
            position: relative;
            padding-top: 25px;
            box-sizing: border-box;
            text-align: center;
            font-size: 26px;
            cursor: pointer;
            position: relative;
            margin-right: 30px;
            margin-bottom: 20px;
            float: left;
        }
        .sv-buy-card .item.active {
            border: 1px solid #ff6200;
            background: #fff url(/template/member/images/service-tips01.png) no-repeat right bottom;
        }
        .sv-buy-card .item.slf {
            font-size: 18px;
        }
        .sv-buy-card .item.slf .p {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding-top: 28px;
        }
        .sv-buy-card .item.slf .input {
            display: none;
            border: none;
            background: none;
            width: 80%;
            margin: 0 auto;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
            color: #ff6200;
            font-size: 18px;
        }

        .pay-type input[type="radio"] {
            display: none;
        }
        .pay-type label {
            color: #999;
            display:inline-block;
            width:80px;
            height:32px;
            line-height:32px;
            text-align:center;
            border:1px solid #dddddd;
            border-radius:2px;
            cursor:pointer;
            font-size:14px;
        }
        .pay-type label:hover {
            border-color:#ff6e19;
            color:#ff6e19;
        }
        .pay-type input[type="radio"]:checked + label {
            border-color:#ff6e19;
            color:#ff6e19;
            background:url(/template/member/images/service-tips01.png) no-repeat right bottom;
        }
        #charge {
            width: 120px;
            height: 40px;
            margin: 25px 0 0 100px;
            color: #ffffff;
            line-height: 40px;
            text-align: center;
            background: linear-gradient(-45deg, #ff5943 0%, #ff8168 100%);
            background: #ff6900\9;
            cursor: pointer;
            border-radius:2px;
        }
    </style>
</head>
<body>
   @include('home.member.header')
    <div class="wrap clear mtop">
        <div class="fl">
            @include('home.member.menu')
        </div>
        <div class="fr" style="width:980px">
            <div class="bgff radius">
                <div class="plr20 pt20 bold">充值/余额</div>
                <div class="fz16 p20">
                   <span>充值账户：</span>
                   <span class="mr20 c-main">{{$account}}</span>
                   <span>当前余额：</span>
                   <span class="c-main">{{$total}} 元</span>
                </div>
            </div>
            <div class="bgff mt20 ptb20 radius">
                @if($pay_setting->type === 'alipay')
                    <div class="plr20">
                        <div class="clear">
                            <span class="fz16 pb10 mt10 fl mr20">充值方式：</span>
                            <div class="pay-type fl mr10">
                                <input type="radio" name="pay_type" value="alipay" id="pay_type_alipay" checked>
                                <label style="width: 150px;height:50px;border-width: 1px;" for="pay_type_alipay">
                                    <img style="width: 70%;margin-top: 4px;" src="/template/member/images/alipay.png">
                                </label>
                            </div>
                        </div>
                        <div class="clear mt30">
                            <span class="fz16 pb10 fl">充值金额：</span>
                            <ul class="sv-buy-card clear fl pl20" id="buy-card" style="width: 840px;">
                                <li class="item active" data="100">100 元</li>
                                <li class="item" data="200">200 元</li>
                                <li class="item" data="500">500 元</li>
                                <li class="item" data="1000">1000 元</li>
                                <li class="item" data="5000">5000 元</li>
                                <li class="item" data="10000">10000 元</li>
                                <li class="item slf" data="custom">
                                    <p class="p" style="">自定义金额</p>
                                    <input class="input" type="text" placeholder="自定义金额" maxlength="5" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}"   =""     onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'0')}else{this.value=this.value.replace(/\D/g,'')}" style="display: none;">
                                </li>
                            </ul>
                        </div>
                        <button type="button" id="charge">确认充值</button>
                    </div>
                    <script>
                        $(function() {
                            $('#buy-card .item').each(function(){
                                $(this).click(function(){
                                    $('#buy-card .item').removeClass('active');
                                    $(this).addClass('active');
                                    if($(this).attr('data')==='custom'){
                                        $(this).find('.p').hide().next().show().focus()
                                    } else {
                                        $('#buy-card .slf').find('.p').show().next().hide()
                                    }
                                })
                            })
                            $('#charge').on('click',function(){
                                var num = 0;
                                $('#buy-card .item').each(function(){
                                    if($(this).hasClass('active')){
                                        if($(this).attr('data')==='custom'){
                                            num = $(this).find('input').val();
                                        } else {
                                            num = $(this).attr('data')
                                        }
                                        
                                    }
                                })
                                charge(num, $('.pay-type').find('input:radio[name="pay_type"]:checked').val())
                            })
                        })
                        function  charge(val, pay_type) {
                            $.ajax({
                                url: '{{route("home.member.finance.pay.create")}}',
                                type: 'POST',
                                data: {'money': val, 'pay_type': pay_type, _token:"{{csrf_token()}}"},
                                success: function (res) {
                                    if (res.code == 0) {
                                        chargeCb(pay_type, res.order_no)
                                    } else {
                                        alert(res.info)
                                    }
                                },
                                error: function () {
                                }
                            })
                        }
                        function chargeCb(pay_type, charge_no) {
                            var urlObj = {
                                'alipay':'/member/pay/alipay/' + charge_no,
                                'wechat':'/member/pay/wechat/' + charge_no,
                            }
                            window.location.href = urlObj[pay_type]
                        }
                    </script>
                @elseif($pay_setting->type === 'qrcode')
                <div>
                    <p class="tx-c fz16" style="color:red;font-weight:bold;letter-spacing:1px;">温馨提示：发布违法违规稿件会直接封号且不退款</p>
                    <div class="tx-c">
                        <img style="width:300px;display:inline-block;vertical-align: top;" src="{{$pay_setting->alipay_qrcode}}" alt="">
                        <div style="width:300px;margin-left:100px;display:inline-block;">
                            <img style="width:300px;margin:10px 0;" src="/template/member/images/wxpay_top.png" alt="">
                            <div style="width:100%;height:372px;background:#22ab39;">
                                <div style="width:100%;height:330px;overflow:hidden;">
                                    <img style="width:100%" src="{{$pay_setting->weixin_qrcode}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt20">
                        <p class="tx-c mb10">使用支付宝/微信扫一扫,输入充值金额.备注用户名.</p>
                        <p class="tx-c">如遇充值问题  详询官方客服 &nbsp;QQ:&nbsp;<a target="_blank" style="color:red;" href="http://wpa.qq.com/msgrd?v=3&amp;uin={{$website->qq}}&amp;site=qq&amp;menu=yes" title="{{$website->qq}}">{{$website->qq}}</a></p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
   @include('home.member.icp')
    
</body>
</html>