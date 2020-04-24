<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录-{{$website->company}}</title>
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>
    <script src="/template/modules/js/ie-placeholder.js"></script>
    <style>
        .header{height:12vh;line-height:12vh;background: #fff;box-sizing:border-box;}
        .header .logo{width:120px;height:50px;margin-top:calc(6vh - 25px);background:url({{$website->logo}}) no-repeat;background-size:cover;}
        .header .rtxt{height:50px;margin-top:calc(6vh - 25px);}
        .banner{background:url({{$image->thumb?$image->thumbs[0]:'/template/member/login/bg.png'}}) no-repeat;height:60vh;background-size:cover;min-height:450px;}
        .banner .wrap{position:relative;}

        .loginForm h4.title{text-align:center;margin-bottom:30px;padding-bottom:12px;position: relative;color: #df5151;font-size:18px;}
        .loginForm h4.title:before{content:"";width: 30px;height: 2px;background-color: #df5151;border-radius: 1px;position:absolute;left:50%;margin-left:-15px;bottom:0px;}
        .loginForm{width:360px;background-color: #ffffff;box-shadow: -13px 13px 19px 1px rgba(0, 0, 0, 0.4);border-radius: 5px;position:absolute;right:0;top:50%;margin-top:-160px;padding:20px 30px;}
        .inputBox{position: relative;}
        .inputBox input{box-sizing:border-box;font-size:14px;padding-left:14px;padding-right:14px; width:100%;height: 48px;line-height:48px;border-radius: 3px;border: solid 1px #cbcbcb;margin-bottom:25px;}
        .yanzCode input{width:170px;}
        .yanzCode a{display:flex;width:157px;height:48px;border-radius: 3px;border: solid 1px #cbcbcb;position:absolute;right:0;top:0;justify-content: center;align-items: center;background-color:#F3FBFE;}
        .verifCode input{padding-right:100px;}
        .verifCode a{border-left:1px solid #e9e9e9;width:100px;height:48px;line-height:48px;text-align:center;font-size:14px;color: #3F8EFC;position:absolute;right:0;top:0;}
        .verifCode a:before{content: '';display: block;width: 6px;height: 6px;border-left: 1px solid #e9e9e9;border-top: 1px solid #e9e9e9; position: absolute;-webkit-transform: translateY(-50%) rotate(-45deg);transform: translateY(-50%) rotate(-45deg);top: 50%;left: -4px;background-color: #fff;}
        .privacy{display: flex;justify-content: flex-start;padding-left:20px;position: relative;color:#999;font-size:12px;margin-bottom:15px;}
        .privacy input[type=checkbox]{display: none;}
        .privacy label{cursor: pointer;}
        .privacy label:before{content:"";display:inline-block;width:14px;height:14px;background:url(/template/member/login/checked_no.png);background-size:cover;position:absolute;left:0;top:2px;}
        .privacy input[type=checkbox]:checked+label:before{content:"";display:inline-block;width:14px;height:14px;background:url(/template/member/login/checked.png);background-size:cover;position:absolute;left:0;top:2px;}
        .privacy a{color:#666;}
        .errorTip{font-size:14px;height:20px;line-height:20px;margin-bottom:10px;padding-left:20px;color:#e45547;background:url(/template/member/login/error.png) left center no-repeat;}
        a.submit{display: block;width:100%;height: 46px;line-height:46px;text-align:center;background-color:#3F8EFC;border-radius: 4px;color:#fff;font-size:18px;margin-bottom:20px;}
        .bottom{display: flex;}
        .bottom .fll{flex:1;display:flex;justify-content: flex-start;font-size:14px;}
        .bottom .fll:nth-of-type(2){justify-content: flex-end;}
        .bottom .fll:nth-of-type(1) a{color:#3F8EFC;}
        .bottom .fll span{color:#999}
        .bottom .fll:nth-of-type(2) a{color: #666666;}
        .loginForm .titleUnit{width:100%;height:30px;margin-bottom:40px;}
        .titleUnit .unite{width:50%;height:30px;position:relative;float:left;cursor: pointer;}
        .titleUnit .unite:nth-of-type(1):after{content:"";width: 1px;height: 20px;background-color: #cbcbcb;position:absolute;top:0px;right:0px;}
        .titleUnit .unite h3.title{text-align:center;color: #999;font-size:18px;}
        .titleUnit .unite.current h3.title{color: #3F8EFC;}
        .titleUnit .unite.current:before{content:"";width: 30px;height: 2px;background-color: #3F8EFC;border-radius: 1px;position:absolute;left:50%;margin-left:-15px;bottom:0px;}

        .footer{padding:40px 0;box-sizing:border-box;}
        .footer a:hover{color:#3F8EFC;}
    </style>
</head>
<body>
    <div class="header ">
        <div class="wrap clear">
            <div class="logo fl"></div>
            <span class="fl c-999 fz30 ml20">登录</span>
            <div class="fr lh1 mt20 rtxt">
                <p class="fz30 mb5" style="color:red;">{{$website->phone}}</p>
                <p>客服时间：{{$website->job_time}}</p>
            </div>
        </div>
    </div>
    <div class="banner">
        <div class="wrap">
            <form class="loginForm">
                <div class="titleUnit" id="titleUnit">
                    <div class="unite current" name="username" style="@if(!$sms_status) width:100% @endif"><h3 class="title">用户名登录</h3></div>
                    @if($sms_status)
                        <div class="unite" name="tel"><h3 class="title">手机号登录</h3></div>
                    @endif
                </div>
                <span id="accountbox">
                    <div class="inputBox input" id="username">
                        <input type="text" placeholder="请输入用户名" id="user">
                    </div>
                    <div class="inputBox">
                        <input type="password" placeholder="请输入密码" id="password">
                    </div>
                </span>
                <span id="phonebox" style="display:none;">
                    <div class="inputBox input" id="tel" >
                        <input type="text" placeholder="请输入手机号" id="mobile" name="phone">
                    </div>
                    <div class="inputBox verifCode">
                        <input type="text" maxlength="6" placeholder="请输入短信验证码" id="mobile_code" name="code">
                        <a href="javascript:void(0);" id="get_code">获取验证码</a>
                    </div>
                </span>
                <div class="errorTip" style="display:none;" id="errorTip"> </div>
                <a class="submit" id="submit_btn" href="javascript:;">登录</a>
                <div class="bottom">
                    <div class="fll"><span>没有账户？</span><a href="/member/register">去注册</a></div>
                    <!-- <div class="fll"><a href="/member/forgot">忘记密码？</a></div> -->
                </div>
            </form>
        </div>
    </div>
    <div class="footer tx-c">
            <div>
                <a href="/">首页</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/new">新闻资讯</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/about/us?type=1">关于我们</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/about/us?type=2">联系我们</a>
            </div>
            <div class="mtb30">
                <img class="mr40" src="/template/member/login/footer01.png" alt="">
                <img class="mr40" src="/template/member/login/footer02.png" alt="">
                <img class="mr40" src="/template/member/login/footer03.png" alt="">
                <img src="/template/member/login/footer04.png" alt="">
            </div>
            <p>Copyright © {{$website->company}} 版权所有&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                <a target="_blank" href="http://beian.miit.gov.cn/" style="color:red;margin-left:10px;">备案查询</a> {{$website->record_num}}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                智能化营销平台，您身边的媒体专家。
            </p>
    </div>
    <script>
    $(function(){
        isLogout();
        Login();
        handleCheck();
        $('#titleUnit').find('.unite').on('click', function(){
            $('#titleUnit .unite').removeClass('current');
            $(this).addClass('current');
            var type = $(this).attr('name')
            if(type === 'username'){
                $('#phonebox').hide();
                $('#accountbox').show();
            }else{
                $('#phonebox').show();
                $('#accountbox').hide();
            }
        });
        getCode('#get_code')
    });
    
    // 获取验证码
    function getCode(dom){
        var code_flag = false;
        $(dom).on('click',function(){
            var phone = $('input[name="phone"]').val()
            if(!phoneNumber(phone)){
                errTip('手机号为空或格式有误');
                return
            }
           
            if (code_flag) { return }
            code_flag = true;
            $(dom).html('发送中...')
            var t = 60,timer;
            $.post("{{route('home.verify')}}", {
                phone:phone,type:'login','_token':'{{csrf_token()}}'
            }, function (res) {
                if(res.code === 0 ){
                    timer = setInterval(function () {
                        if (t<=0) {
                            t = 60;
                            code_flag = false;
                            clearInterval(timer);
                            $(dom).html('获取验证码');
                        } else {
                            t--;
                            $(dom).html('发送成功('+t+'s)');
                        }
                    }, 1000);
                }else{
                    errTip(res.info)
                }
                
            }).error(function (err) {  });
        })
    }
    function Login() {
        var login_flag = true,login_flag1 = true;
        $("#submit_btn").click(function() {
            //获取数据
            var type =  $('#titleUnit').find('.unite.current').attr('name')
            if(type=='username'){
                var username = $("#user").val()
                var password = $("#password").val()
                if(!nameNumber(username)){
                    errTip('用户名为空或格式有误');
                    return;
                }
                if(!passwordNumber(password)){
                    errTip('密码为空或格式有误');
                    return;
                }
                //异步提交
                if(!login_flag){ return }
                login_flag = false;
                setTimeout(function() {
                    login_flag = true; 
                }, 2000);
                sendData({username:username,password:password})
            }else{
                var phone = $('input[name="phone"]').val()
                var code = $('input[name="code"]').val()
                if(!nameNumber(phone)){
                    errTip('手机号为空或格式有误');
                    return;
                }
                if(!codeNumber(code)){
                    errTip('验证码为空或格式有误');
                    return;
                }
                //异步提交
                if(!login_flag){ return }
                    login_flag = false;
                setTimeout(function() {
                    login_flag = true; 
                }, 2000);
                sendDataPhone({phone:phone,code:code})
            }
        })
        $('#password').bind('keypress',function(event){
            if(event.keyCode == "13"){
                var username = $("#user").val()
                var password = $("#password").val()
                if(!username){
                    errTip('请输入用户名');
                }else if(!password || password.length < 6 || password.length > 18) {
                    errTip('请输入密码');
                }else{
                    //异步提交
                    if(!login_flag1){ return }
                    login_flag1 = false;
                    setTimeout(function() {
                        login_flag1 = true; 
                    }, 1000);
                    sendData({username:username,password:password})
                }
                return false;
            }
        });
    }
    function sendDataPhone(obj) {
        obj['_token'] = '{{csrf_token()}}';
        $.post("{{route('home.login.phone')}}", obj, function (res) {
            if (res.code === 0) {
                $('#submit_btn').html('登录中...')
                setTimeout(function () {
                    window.location.href= "{{route('home.member')}}"
                }, 500);
            } else {
                errTip(res.info)
            }
        }).error(function (error) {
            
        });
    }
    function sendData(obj) {
        $.post("{{route('home.login.check')}}", {
            username:obj.username,password:obj.password,'_token':'{{csrf_token()}}'
        }, function (res) {
            if (res.code === 0) {
                $('#submit_btn').html('登录中...')
                setTimeout(function () {
                    window.location.href= "{{route('home.member')}}"
                }, 500);
            } else {
                errTip(res.info)
            }
        }).error(function (error) {
            
        });
    }
    function errTip(text) {
        $('#errorTip').show().html(text).delay(2000).fadeOut();
    }

    function isLogout() {
        if(getUrlParam('logout')==='1'){
            localStorage.removeItem('username');
        }
    }
    function getUrlParam(n) {
        var a = new RegExp("(^|&)" + n + "=([^&]*)(&|$)"),
        t = window.location.search.substr(1).match(a);
        return null != t ? decodeURI(t[2]) : null
    }
    function space(str) {
        if (typeof str === 'string') {
        return str.replace(/(^\s*)|(\s*$)/g, "");
        }
        return str;
    }
    //---------- 手机号码验证 ----------
    function phoneNumber (str) {
        str = space(str);
        var reg = /^[1][3-9][0-9]{9}$/
        return reg.test(str)
    }
    //---------- 密码验证 ----------
    function passwordNumber (str) {
        str = space(str);
        var reg =/^[0-9A-Za-z]{6,16}$/
        return reg.test(str)
    }
    //---------- 账户验证 ----------
    function nameNumber (str) {
        str = space(str);
        var reg = /^[0-9a-zA-z]\w{3,20}$/;
        return reg.test(str)
    }
    //---------- 验证码验证 ----------
    function codeNumber (str) {
        str = space(str);
        var reg = /^[0-9]{4,6}$/;
        return reg.test(str)
    }
</script>
</body>
</html>