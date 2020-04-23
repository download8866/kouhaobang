<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>创建内容-{{$website->company}}</title>
    <link rel="stylesheet" href="/template/modules/css/icon.css">
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>

    <link rel="stylesheet" href="/static/home/layui/css/layui.css" media="all">
    <script src="/static/home/layui/layui.js"></script>
    <script src="/template/modules/js/ie-placeholder.js"></script>
    <style>
        .layui-form-label{box-sizing:border-box;padding-left:0;width:110px;}
        .edui-editor{z-index:1!important;}
        .dots{color:red;}
        .width-in{width:580px;}
        .my-upload-drag {width:464px;color: #455A64;padding: 10px 0;background: #fff;border: 3px dashed #607D8B;border-radius: 2px;
            -webkit-transition: background .15s linear,border .15s linear,color .15s linear,opacity .15s linear;
            transition: background .15s linear,border .15s linear,color .15s linear,opacity .15s linear;}
        .my-upload-drag:hover{background: #CFD8DC; border-color: #546E7A; color: #263238;}
        .course-cate-box {display: inline-block;height: 38px;line-height: 38px;vertical-align: middle;}
        .course-cate-item {padding: 0 20px;margin-right: 4px;background: #f2f2f2;cursor: pointer;}
        .course-cate-item.active,.course-cate-item:hover { background: #4eb6ff;color: white;position: relative;}
        .course-cate-item.active:after{position: absolute; content: '';bottom: 0;left: 50%; margin-left: -8px;width: 0;height: 0px; border-width: 8px;border-style: solid;border-left-color: transparent; border-top-color: transparent; border-right-color: transparent;}
        .notices {margin-left:130px;width: 800px;padding: 22px;background-color: #f9f5f2;border: solid 1px #ffe3cf;box-sizing: border-box;}
        .notices p {font-size: 14px;color: #666;}
        .btnss button {width: 124px;height: 44px;line-height: 42px;border: none;color: white;font-size: 16px; display:inline-block;cursor: pointer;}
        .btnss button.views { background-color: #83d587;border-radius: 2px; }
        .btnss button.nextStep {background-color: #ff6c00;border-radius: 2px;}
        .btnss button.backOrder {background-color: #ff6c00;border-radius: 2px;display: none;}
    </style>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body>
   @include('home.member.header')
    <div class="wrap clear mtop">
        <div class="fl">
            @include('home.member.menu')
        </div>
        <div class="fr" style="width:980px">
            <form class="bgff layui-form pb30 radius"  id="myForm"  method="post" >
                <div class="clear p20">
                    <ul class="course-cate-box clear fl">
                        @if(strstr($apply, 'sarticle'))
                        <li class="course-cate-item fl active" data-cate="1">软文发布</li>
                        @elseif(strstr($apply, 'zimeiti'))
                        <li class="course-cate-item fl" data-cate="2">自媒体发布</li>
                        @endif
                    </ul>
                </div>
                <div class="p20 fz16">
                    <div class="layui-form-item">
                        <label class="layui-form-label">上传文档：</label>
                        <div class="layui-input-block">
                            <div class="layui-upload-drag my-upload-drag" id="test10">
                                <p>若无链接，请将文档拖至本框内，既可自动生成，支持DOCX、DOC格式，文档不超过10M。</p>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item position-re width-in">
                        <label class="layui-form-label dots"><i>*</i>文章标题：</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" lay-verify="title"  autocomplete="off" placeholder="建议文章标题40字内，不要出现特殊字符" class="layui-input titles">
                        </div>
                        <div style="right:-340px;top:0;width:320px;" class="position-ab fz14 c-3d3d3f">
                            <p id="shengxiazi">还可以输入 <em style="color:red;">40</em> 个字</p>
                            <p id="ziduole" style="color:red;display:none;">标题长度超过限制</p>
                            <p>建议标题字数40字内，太长了有些编辑会自动修改</p>
                        </div>
                    </div>
                    <div class="layui-form-item width-in">
                        <label class="layui-form-label">来源链接：</label>
                        <div class="layui-input-block">
                            <input type="text" name="link" lay-verify="url" autocomplete="off" placeholder="若填写稿件来源链接，则以稿件链接发布！" class="layui-input link">
                        </div>
                    </div>
                    <div class="layui-form-item width-in">
                        <label class="layui-form-label">备 注：</label>
                        <div class="layui-input-block">
                            <input type="text" name="mark" lay-verify="" autocomplete="off" placeholder="若填写稿件来源链接，则以稿件链接发布！" class="layui-input link">
                        </div>
                    </div>
                   
                    <div class="layui-form-item">
                        <label class="layui-form-label">内 容：</label>
                        <div class="layui-input-block">
                            <textarea name="content" id="container" style="min-height: 500px;min-width:96%;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="btnss tx-c mb30">
                    <button class="views mr20" lay-filter="views"  lay-submit="">预览</button>
                    <button class="nextStep" lay-filter="nextStep"  lay-submit="">下一步</button>
                    <button class="backOrder" lay-filter="backOrder"  lay-submit="">确认提交</button>
                </div>
                <div class="notices">
                    <p style="font-size: 16px;">注意事项</p>
                    <p>1、文章内容必须属于合法内容，如有负面、涉政、敏感等一律不予发布并停止账号使用。</p>
                    <p>2、文章提交发布后不可修改、取消或删除，请在提交之前确认好文章内容。</p>
                    <p>3、一篇文章的发布时间为1-36小时以内，平均大约花费6小时。稿件时效默认为1个月,如有备注以资源备注为准。</p>
                    <p>4、审稿时间为：周一至周五 09:00-18:00，下午16点后提交的文章在隔天发布。</p>
                    <p>5、所选资源可能会因为审稿不达标，导致个别所选资源不能发布，届时会建议您更换资源或退款。</p>
                    <p>6、不能带网址的一律不能带电话、QQ、微信等信息，百度新闻源根据文章质量不保证100%收录。</p>
                    <p>7、文章标题22字以内，内容500~2500字内，图片0~3张内，图片宽度500像素内，资源可能会对文章进行适当的调整。</p>
                    <p>8、文章中包含的网址、电话、图片过大、图片过多等，资源会根据内容规范进行调整或者删减，属于正常情况。</p>
                    <p>9、word文档上传之后请仔细检查，是否与编辑器内显示一致，请确认一致后再继续操作。</p>
                    <p>10、包收录的资源,若稿件未收录,请在第二个工作日中午12点前提交反馈,有特殊要求的资源请按照资源备注操作(例:周五出的稿件,在周六日非正常工作日的情况下,最晚在下周一中午12点前反馈未收录)</p> 
                    <p>11、稿件发布频道不保证，编辑根据稿件内容安排频道</p>
                    <p>12、所有成功发布的稿件，除了发布在手机端品宣资源的专稿，其他稿件一律不保证手机端可以打开。</p>
                </div>
            </form>
        </div>
    </div>
    @include('home.member.icp')
    @include('vendor.ueditor.head')
    <script>
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
    </script>
    <script>
        var preData = {}, actid = '';
        layui.use(['form','upload'], function(){
            var form = layui.form
            ,layer = layui.layer
            ,upld = {}
            ,upload = layui.upload
            ,againPay = doStr();
            if(againPay){
                ue.setContent(againPay.content);
                $('input[name="title"]').val(againPay.title)
                $('input[name="link"]').val(againPay.reference_url)
                $('input[name="mark"]').val(againPay.mark)
                var len = 40 - $('.titles').val().length;
                if(len>=0){
                    $('#shengxiazi').show().find('em').html(len)
                    $('#ziduole').hide()
                }else{
                    $('#shengxiazi').hide()
                    $('#ziduole').show()
                }
                if(getUrlParam('act')){
                   $('.nextStep').hide().next().show()
                }
            };
           //拖拽上传
            upload.render({
                elem: '#test10'
                ,url: '/uploadFile'
                ,choose:function () {
                    var browser=navigator.appName
                    var b_version=navigator.appVersion
                    var version=b_version.split(";");
                    var trim_Version=version[1].replace(/[ ]/g,"");
                    if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE9.0")
                    {
                        layer.msg('ie9不支持上传素材，请升级浏览器',{icon:1,time:2000})
                        return false
                    }
                }
                ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                    layer.load(1); //上传loading
                }
                ,done: function(res, index, upload){ //上传后的回调
                    layer.closeAll('loading'); //关闭loading
                    upld = res.data;
                    layer.msg('上传成功',{icon:1,time:2000})
                    ue.setContent(res.data.content)
                }
                ,error: function(index, upload){
                    layer.closeAll('loading'); //关闭loading
                }
                ,accept: 'file' //允许上传的文件类型
                ,size: 5120 //最大允许上传的文件大小
                ,exts:'docx'
            });
            handleCheck()
            inputOnchange();
            function inputOnchange(){
                $('.titles').bind('input',function(){
                    var len = 40 - $(this).val().length;
                    if(len>=0){
                        $('#shengxiazi').show().find('em').html(len)
                        $('#ziduole').hide()
                    }else{
                        $('#shengxiazi').hide()
                        $('#ziduole').show()
                    }
                })
            }
            form.verify({
                title: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (!value) {
                        return '文章标题不能为空';
                    }else if(value.length>40){
                        return '文章标题不能超40个字符，请修改文章标题再提交，谢谢！';
                    }
                },
                url: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (value) {
                        var reg = /^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/;
                        if(!reg.test(value)){
                            return '来源链接格式不正确';
                        }
                    }
                }
            })

            form.on('submit(backOrder)', function(data) {
                upData(data,function (params) {
                    location.href = '/member/sarticle/order';
                })
                return false
            });
            form.on('submit(nextStep)', function(data) {
                upData(data,function (params) {
                    location.href = '/member/sarticle?act=' + actid;
                })
                return false
            });
            form.on('submit(views)', function(data) {
                upData(data,function (param) {
                    window.open(location.origin+'/active/view/'+actid,'_blank');
                })
                return false
            });
            function upData(data,cb) {
                if(!ue.getContent()){
                    layer.msg('请添加文档资源',{icon:2,time:2000})
                    return false;
                }
                var pars = data.field, isOne = false;
                pars['path'] = upld.path || '';
                pars['content'] = ue.getContent();
                pars['upload_name'] = upld.originName || '';
                for(var k in pars){
                    if(pars[k] != preData[k]){
                        isOne = true;
                    }
                }
                if(getUrlParam('act')){
                    pars['act'] = getUrlParam('act')
                }
                preData = pars;
                if(isOne){
                    $.ajax({
                        url: "/member/active/store",
                        type: 'post',
                        data: pars,
                        success: function (res) {
                            actid = res.act;
                            if(res.code == 0){
                                cb()
                            }else if(res.code==1){

                            }
                        },
                        error: function () {
                            
                        }
                    })
                }else{
                    cb()
                }
            }
        });
        // 文档资源
        function doStr(){
            var str = "{{$act}}";
                str = str.replace(/src=&quot;/g,"src='");
                str = str.replace(/&quot;\/&gt;/g,"'/>");
                str = str.replace(/&lt;/g,'<');
                str = str.replace(/&gt;/g,'>');
                str = str.replace(/&quot;/g,'"');
                try {
                    //在这里运行代码
                    str = JSON.parse(str)
                } catch(err) {
                    //在这里处理错误
                    str = null
                }
            return str;
        }
        function getUrlParam(n) {
            var a = new RegExp("(^|&)" + n + "=([^&]*)(&|$)"),
            t = window.location.search.substr(1).match(a);
            return null != t ? decodeURI(t[2]) : null
        }
    </script>
</body>
</html>