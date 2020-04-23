<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>基本信息-{{$website->company}}</title>
    <link rel="stylesheet" href="/template/modules/css/icon.css">
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>

    <link rel="stylesheet" href="/static/home/layui/css/layui.css" media="all">
    <script src="/static/home/layui/layui.js"></script>
    <style>
        .basic-ul {min-height:60vh;}
        .basic-ul li {float: left;width: 100%;padding: 10px 0;margin-bottom:20px;}
        .basic-ul li .lable{float: left; width: 100px;}
        .basic-ul li i{color: #4eb6ff;cursor: pointer;}
        .basic-ul li .val{color: #999;    display: inline-block;
    min-width: 123px;
    margin-right: 13px;}
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
                <div class="p20 fz18 bb">基本信息</div>
                <div class="bgff tx-c mtb20"><img src="/template/member/images/basic.png" alt=""></div>
                <ul class="basic-ul clear plr20 fz14" style="width:300px;margin:0 auto;">
                    <!-- <li>
                        <p class="lable">登录信息</p>
                        <div class="clear pl20" style="height:210px;background: #f5f7fa;margin-left:100px;margin-right:40px;">
                            <img class="fl mr20" width="60" src="/template/member/images/basic.png" alt="">
                            <div class="fl fz12">
                                <p>邮箱：<em class="c-999">{{$info->email??'--'}}</em></p>
                                <p class="mtb5">手机号：<em class="c-999">{{$info->mobile??'--'}}</em></p>
                                <p>密码：<em class="c-999">******</em></p>
                            </div>
                        </div>
                    </li> -->
                    <li>
                        <p class="lable">公司名称</p>
                        <span class="val">{{$info->company}}</span>
                        <i class="iconfont icon-edit" data-type="company"></i>
                    </li>
                    <li>
                        <p class="lable">登录名</p>
                        <span class="val">{{$info->name??'--'}}</span>
                        <i class="iconfont icon-edit" data-type="name"></i>
                    </li>
                    <li>
                        <p class="lable">行业信息</p>
                        <span class="val">{{$info->industry??'--'}}</span>
                        <i class="iconfont icon-edit" data-type="industry"></i>
                    </li>
                    <li>
                        <p class="lable">联系人</p>
                        <span class="val">{{$info->username??'--'}}</span>
                        <i class="iconfont icon-edit" data-type="username"></i>
                    </li>
                    <li>
                        <p class="lable">联系电话</p>
                        <span class="val">{{$info->mobile??'--'}}</span>
                        <i class="iconfont icon-edit" data-type="mobile"></i>
                    </li>
                    <li>
                        <p class="lable">联系邮箱</p>
                        <span class="val">{{$info->email??'--'}}</span>
                        <i class="iconfont icon-edit" data-type="email"></i>
                    </li>
                </ul>
            </div>
        </div>
    </div>
   @include('home.member.icp')
  
    <script>
       layui.use(['form'], function(){
            var form = layui.form
            ,layer = layui.layer
            $('.icon-edit').on('click',function(){
                var ss = {
                    'company': '公司名称',
                    'email': '联系邮箱',
                    'mobile': '联系电话',
                    'username': '联系人',
                    'industry': '行业信息',
                    'name': '登录名称',
                }
                setPayPass(ss, $(this).attr('data-type'))
            })
        })
         /*设置密码*/
        function setPayPass(ob, ty){
            var password_set_flag = false,title = ob[ty]
            layer.open({
                type: 1
                ,area:['360px','200px']
                ,tipsMore: true
                ,btn: ['提交'] //可以无限个按钮
                ,title: title
                ,content: '<ul style="width:280px;margin: 40px auto 0;">'
                            +'<li><span>'+ title +'：&nbsp;</span><span class="position-re" style="display: inline-block;"><input maxlength="15"  style="padding:6px;border:1px solid #e0e0e0;" id="setp" type="text" placeholder="请输入'+ title +'"></span></li>'
                            +'</ul>'
                ,success:function(){
                    // handleCheck()
                }
                ,yes: function(index, layero){
                    var pars = {},setpw1 = $('#setp').val();
                    var regs = /^\d{6}$/;
                    if(!setpw1){
                        layer.msg('请完善  '+ title,{icon:2,time:2000})
                        return
                    }
                    if(ty=='mobile'){
                        if(!phoneNumber(setpw1)){
                            layer.msg('手机号格式不对！',{icon:2,time:2000})
                            return
                        }
                    }else if(ty=='name'){
                        if(!nameNumber(setpw1)){
                            layer.msg('登录名格式不对！',{icon:2,time:2000})
                            return
                        }
                    }else if(ty=='email'){
                        if(!emailNumber(setpw1)){
                            layer.msg('邮箱格式不对！',{icon:2,time:2000})
                            return
                        }
                    }
                    pars[ty] = setpw1
                    pars['_token'] = "{{csrf_token()}}"
                    if(password_set_flag){
                        return
                    }
                    password_set_flag = true
                    $.ajax({
                        url: "basic/update",
                        type: 'POST',
                        data: pars,
                        success: function (res) {
                            $('.icon-edit').each(function(){
                                if($(this).attr('data-type')==ty){
                                    $(this).prev().html(setpw1)
                                }
                            })
                            layer.close(index)
                            layer.msg(res.info,{icon:1,time:2000})
                            setTimeout(function(){
                                password_set_flag = false
                            }, 1000);
                        },
                        error: function () {
                            setTimeout(function(){
                                password_set_flag = false
                            }, 1000);
                        }
                    })
                   
                }
            })
        }
        function space(str) {
            if (typeof str === 'string') {
            return str.replace(/(^\s*)|(\s*$)/g, "");
            }
            return str;
        }
        
        // 账户验证
        function nameNumber(str) {
            str = space(str);
            var reg = /^[a-zA-z]\w{2,15}$/;
            return reg.test(str)
        }
        // 手机号验证
        function phoneNumber(str) {
            str = space(str);
            var reg = /^[1][3-9][0-9]{9}$/;
            return reg.test(str)
        }
        // 密码验证
        function passwordNumber(str) {
            str = space(str);
            var reg = /^[0-9A-Za-z]{6,20}$/;
            return reg.test(str)
        };
        // 验证码 验证
        function codeNumber(str) {
            str = space(str);
            if (!str) {
            return false
            }
            var reg = /^[0-9]*$/;
            return reg.test(str)
        };
        // 邮箱 验证
        function emailNumber(str) {
            str = space(str);
            var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
            return reg.test(str)
        };
        // 非空 验证
        function spaceNumber(str) {
            str = space(str);
            var reg = /\S/;
            return reg.test(str)
        };
    </script>
</body>
</html>