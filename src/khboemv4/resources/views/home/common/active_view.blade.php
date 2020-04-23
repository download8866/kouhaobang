
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none">
    <title>{{$name}}</title>
    <link rel="stylesheet" type="text/css" href="/template/member/activeshow/preview/base.css" />
    <link rel="stylesheet" type="text/css" href="/template/member/activeshow/preview/style.css" />
    <link rel="stylesheet" type="text/css" href="/template/member/activeshow/preview/news.css" />

    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/template/member/activeshow/js/xss1.js"></script>
    <style>
        p img {text-align: center;}
        .wrapindex {position: relative;}
        .wrapindex .statement {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -khtml-user-select: none;
            position: absolute;
            bottom: 0px;
            left: 0px;
            text-align: center;
            width: 100%;
            z-index: -1;
        }

        .ourStatement {
            width: 100%;
            height: 20px;
            background: url(/template/activeshow/img/bottom_img.png) center center no-repeat;
            position: absolute;
            bottom: -47px;
            left: 0px;
            z-index: 6;
        }

        .remark {
            position: absolute;
            width: 150px;
            height: auto;
            right: -150px;
            top: 70px;
            border-radius: 10px;
            padding: 10px;
            font-size: 14px;
            line-height: 24px;
            z-index: 666;
            /*            -moz-user-select:none;
                        -webkit-user-select:none;
                        -ms-user-select:none;
                        user-select:none;*/
            background: #eee;
        }

        .remark_arr {
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-left: 25px solid transparent;
            border-right: 25px solid #eee;
            border-bottom: 15px solid transparent;
            position: absolute;
            top: 10px;
            left: -50px;
        }

        .remark_msg {
            height: auto;
            overflow: hidden;
            word-break: break-all;
            text-overflow: ellipsis;
        }

        .small_tips {
            position: absolute;
            left: 15px;
            top: 50px;
            font-size: 18px;
            color: #f00;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .post-title {line-height: 40px;}

        .corner {
            position: absolute;
            width: 100px;
            height: 100px;
            background: url(/template/activeshow/img/corner.png) center center no-repeat;
            background-size: cover;
            bottom: -9px;
            right: -8px;
            z-index: 6;
        }

        .statement {
            font-size: 15px;
            text-align: center;
            color: #f00;
            margin-bottom: 30px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .post-content {
            min-height: 100px
        }

        button.copyBtn {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            width: 70px;
            height: 34px;
            border: 0;
            outline: 0;
            background: url(/template/activeshow/img/copy_btn_bg.png);
            background-size: cover;
            line-height: 34px;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            position: absolute;
            right: 8px;
            top: 32px;
        }

        #tips {position: absolute; top: 150px;left: 0;right: 0; margin: auto;width: 150px; height: 38px; line-height: 38px; background-color: rgba(0, 0, 0, .6);color: #fff; font-size: 16px;text-align: center;z-index: -666;opacity: 0;transition: opacity linear .3s;}
        #tips.show {opacity: 1;z-index: 666;}
    </style>
</head>

<body>
    <div id="wrapmain">
        <center><span style="font-size: 30px; color: rgb(255, 0, 0);">
            </span>
        </center>
        <div class="maincont clearfix">
            <div class="wrapindex clearfix">
                <div class="homeleft corner5px mb15">
                    <div class="remark">
                        <p class="remark_msg"><span style="color: red;">备注信息：{{$mark}}</span></p>
                        <span class="remark_arr"></span>
                    </div>
                    <div class="small_tips">安排: {{$title}}</div>
                    <div class="clearfix" id="content">
                        <!-- style="overflow: visible;"-->
                        <button id="copy" class="copyBtn"></button>
                        <div class="post-title">
                            <center><span style="font-size: 24px;">{{$name}}</span></center>
                        </div>
                        <div class="bk30"></div>
                        <div class="b2"></div>
                        <div class="clearfix"></div>
                        <div class="post-content clearfix" id="copy_area"></div><!-- style="overflow: visible;"-->
                    </div>
                    <div class="corner"></div>
                    <div class="ourStatement"></div>
                </div>
                <div class="bk60">

                </div>

            </div>
        </div>
    </div>
    <div id="tips"></div>
    <script type="text/javascript" src="/template/activeshow/js/clipboard.min.js"></script>
    <script>
        $(function () {
            // clean_html = filterXSS(cc));
            $("#copy_area").html(doStr());
        });

        function doStr(){
            var str = "{{$content}}";
            str = str.replace(/&lt;/g,'<');
            str = str.replace(/&gt;/g,'>');
            str = str.replace(/&quot;/g,'"');
            return str;
        }
        function showTips(str) {
            var tips = document.getElementById('tips');
            tips.innerHTML = str;
            tips.className = 'show';
            setTimeout(function () {
                tips.className = '';
            }, 2000)
        }
        var clipboard = new ClipboardJS('#copy', {
            target: function () {
                return document.getElementById('copy_area');
            }
        });
        clipboard.on('success', function (e) {
            showTips("复制成功");
        });

        clipboard.on('error', function (e) {
            showTips("<span style='color: #f00'>失败</span>");
        });
    </script>
</body>

</html>