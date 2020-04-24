<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册-{{$website->company}}</title>
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>
    <script src="/template/modules/js/ie-placeholder.js"></script>
    <style>
        .header{height:12vh;line-height:12vh;background: #fff;box-sizing:border-box;}
        .header .logo{width:120px;height:50px;margin-top:calc(6vh - 25px);background:url({{$website->logo}}) no-repeat;background-size:cover;}
        .header .rtxt{height:50px;margin-top:calc(6vh - 25px);}
        .banner{background:url({{$image->thumb?$image->thumbs[0]:'/template/member/login/bg.png'}}) no-repeat;height:60vh;min-height:500px;background-size:cover;}
        .banner .wrap{position:relative;}

        .loginForm h4.title{text-align:center;margin-bottom:20px;padding-bottom:12px;position: relative;color: #3F8EFC;font-size:18px;}
        .loginForm h4.title:before{content:"";width: 30px;height: 2px;background-color: #3F8EFC;border-radius: 1px;position:absolute;left:50%;margin-left:-15px;bottom:0px;}
        .loginForm{width:360px;background-color: #ffffff;box-shadow: -13px 13px 19px 1px rgba(0, 0, 0, 0.4);border-radius: 5px;position:absolute;right:0;top:50%;margin-top:-230px;padding:20px 30px;}
        .inputBox{position: relative;}
        .inputBox input{box-sizing:border-box;font-size:14px;padding-left:14px;padding-right:14px; width:100%;height: 36px;line-height:36px;border-radius: 3px;border: solid 1px #e9e9e9;margin-bottom:10px;}
        .yanzCode input{width:230px;display: inline-block;vertical-align:top;}
        .yanzCode img{height:36px;}
        .verifCode input{padding-right:100px;}
        .verifCode a{border-left:1px solid #e9e9e9;width:100px;height:36px;line-height:36px;text-align:center;font-size:14px;color: #3F8EFC;position:absolute;right:0;top:0;}
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
    <div class="header">
        <div class="wrap clear">
            <div class="logo fl"></div>
            <span class="fl c-999 fz30 ml20">注册</span>
            <div class="fr lh1 mt20 rtxt">
                <p class="fz30 mb5" style="color:red;">{{$website->phone}}</p>
                <p>客服时间：{{$website->job_time}}</p>
            </div>
        </div>
    </div>
    <div class="banner">
        <div class="wrap">
            <form class="loginForm"  >
                <h4 class="title">注册账号</h4>
                <div class="inputBox">
                    <input type="text" maxlength="20" placeholder="请输入用户名(英文,数字[4-20位])" id="username">
                </div>
                <div class="inputBox">
                    <input type="password" maxlength="16" placeholder="请输入密码(6-16位)" id="password">
                </div>
                <div class="inputBox">
                    <input type="password" placeholder="请确认密码" id="again_pwd">
                </div>
                <div class="inputBox">
                    <input type="tel" placeholder="请输入手机号" id="mobile" name="phone">
                </div>
                @if($sms_status)
                    <div class="inputBox verifCode">
                        <input type="text" maxlength="6" placeholder="请输入短信验证码" id="mobile_code">
                        <a href="javascript:void(0);"  id="get_code">获取验证码</a>
                    </div>
                @else
                    <div class="inputBox yanzCode">
                        <input type="text" maxlength="6" placeholder="请输入图片验证码" id="reg_code">
                        <img src="{{ captcha_src('flat') }}" class="yzm vcode-img pointer" title="点击更换验证码">
                    </div>
                @endif
                <div class="privacy">
                    <input type="checkbox" id="agree" checked>
                    <label for="agree">我已阅读并同意</label>
                    <a href="javascript:;" class="service-btn">《注册协议》</a>
                </div>
                <!-- 错误信息提示 -->
                <div class="errorTip" style="display:none;" id="errorTip"></div>
                <a class="submit" id="submit_btn" href="javascript:void(0);">立即注册</a>
                <a class="submit" style="background:#999;display:none;" href="javascript:void(0);">立即注册</a>
                <div class="bottom">
                    <div class="fll"><span>已有账号？</span><a href="/member/login">去登录</a></div>
                    <!-- <div class="fll"><a href="#">忘记密码？</a></div> -->
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
    <div id="service-box" style="display:none;position:fixed;top:0;right:0;left:0;bottom:0; z-index:99999;background:rgba(0, 0, 0, 0.5)">
        <div style="
            background:#fff;
            font-size: 16px;
            width: 600px;
            border-radius: 2px;
            position: absolute;
            padding:26px 16px;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            -webkit-transform: translate(-50%,-50%);
            -o-transform: translate(-50%,-50%);
            -moz-transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);">
            <div style="padding:10px;">
                    <p style="text-align:center;font-size: 20px;font-weight: bold;margin-bottom: 20px;">注册协议</p>
                    <div class="service-content" style=" width: 100%;overflow: auto;height:400px;">
                    </div>
                </div>
            <img class="ysgb" onClick="$(this).parents('#service-box').hide()" style="width:16px;position:absolute;right:10px;top:10px;cursor:pointer;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAABhElEQVQ4T62Vu07DMBSGf6t5ApgQ8AYssLBWsqsgJi47F4k3YAREETDyBkhcdgoLiKjHUlcWuvAG3CZ4AldGJ3IiNzgNLbXUKvLx/8U3fREoaVLKFSHEHIB5AItu2BOArrX2RWt9F4qKYme9Xp+JougcQFz2MtefGGN2Op3Omz+uD6iU2gBwVQEqljeJ6DrrzIGNRkNaa2lIWDpcCKHa7bZOn/kvjuOJXq/3NQosy9RqtckkSb5ToJTyQgix9R+gtfZSa70tlFJrAG6KMCLi2iGAZqHWJKIjpZQNTGCdQycA9gLFLOhDQ31+9JSB9wCWS5brA+BmFpp1Fn9g4AeAqQH7l0K5XrIFfvSTgXwxp8cEfGcgHwgfTKgNu+QWA/cBHI/pUA6Ek8DtOK6NtXY1vdhKqcc/yKDq3idEtJQCnWFeqxKD6saYWTZPLocRTZO9IzdOn75GMY5vmtw2/lLYPMaYsypZsAyiKNplw/j5X8bOik4aC+4TwJ8Bbl33eyaiVmhPfwDZP7VATq64sQAAAABJRU5ErkJggg==" alt="">
        </div>
    </div>
    <script>
        $(function(){
            handleCheck();
            getCode('#get_code');
            $(".yzm").click(function(){
                $(this).attr("src", "{{ captcha_src('flat') }}?_t" + Math.random());
            });
            var reg_flag = true; 
            $("#submit_btn").click(function() {
                if(!reg_flag){ return }
                reg_flag = false;
                setTimeout(function() { reg_flag = true; }, 2000);
                //获取数据
                var _this = this;
                var username = $("#username").val();
                var password = $("#password").val();
                var again_pwd = $("#again_pwd").val();
                var mobile = $("#mobile").val();
                var mobile_code = $("#mobile_code").val();
                var reg_code = $("#reg_code").val();
                if(!nameNumber(username)) {
                    errTip('用户名为空或格式错误！')
                    return;
                }
                if(!passwordNumber(password)) {
                    errTip('密码为空或格式错误！')
                    return;
                }
                if(password !== again_pwd) {
                    errTip('两次密码不一致')
                    return;
                }
                if(!phoneNumber(mobile)){
                    errTip('请填写正确的手机')
                    return;
                }
                $(_this).html('注册中...');
                //异步提交
                $.post("{{route('home.register.store')}}", {
                username:username,password:password,phone:mobile,captcha:reg_code,code:mobile_code,'_token':'{{csrf_token()}}'
                }, function (res) {
                    if (res.code === 0) {
                        setTimeout(function () {
                            $(_this).html('立即注册');
                            window.location.href= "{{route('home.login')}}"
                        }, 1500);
                    } else {
                        $(_this).html('立即注册');
                        errTip(res.info)
                    }
                }).error(function (data) {$(_this).html('立即注册');});
            })
            $('.service-btn').on('click',function(){
                $.ajax({
                    url: "{{route('home.get.server.register')}}",
                    type: 'POST',
                    data: {'_token':'{{csrf_token()}}'},
                    success: function (res) {
                       $('#service-box').show().find('.service-content').html(res.data.content)
                    },
                    error: function () {
                    
                    }
                })
            })
            $('.privacy input').bind('input',function(){
                var bt = $(this).prop("checked");
                if(bt){
                    $($('.submit')[0]).show()
                    $($('.submit')[1]).hide()
                }else{
                    $($('.submit')[0]).hide()
                    $($('.submit')[1]).show()
                }
            })
        });

        function errTip(text) {
            $('#errorTip').show().html(text).delay(2000).fadeOut();
        }

        // 获取验证码
        function getCode(dom){
            var code_flag = false;
            $(dom).on('click',function(){
                var phone = $('input[name="phone"]').val()
                if(!phoneNumber(phone)){
                    errTip('手机号格式有误');
                    return
                }
                if (code_flag) { return }
                code_flag = true;
                $(dom).html('发送中...')
                var t = 60,timer;
                $.post("{{route('home.verify')}}", {
                    phone:phone,type:'register','_token':'{{csrf_token()}}'
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
                        $(dom).html('获取验证码')
                        errTip(res.info)
                    }
                    
                }).error(function (err) {  });
            })
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