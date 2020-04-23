
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{$info->title}}</title>
    <style>
        @charset "UTF-8";
        html,
        body,
        div,
        span,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        address,
        big,
        code,
        em,
        img,
        q,
        s,
        strike,
        strong,
        syt,
        sup,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        form,
        label,
        legend,
        table,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        footer,
        header,
        nav,
        section,
        audio,
        video,
        button,
        input {
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            font: inherit;
            font-weight: normal;
            font-family: "PingFang SC", "Lantinghei SC", "Siyuan", "Microsoft YaHei", "微软雅黑", SimSun, Arial;
            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-tap-highlight-color: transparent;
        }

        em,
        i {
            font-style: normal;
        }

        b,
        strong {
            font-weight: normal;
        }

        body {
            background: #f5f7fa;
        }

        img {
            border: none;
            vertical-align: middle;
            max-width: 100%;
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
            box-sizing: border-box;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        a {
            text-decoration: none;
            color: #000;
        }

        a:active {
            outline: 0;
        }

        .clear:after,
        .clear:before {
            content: "";
            display: block;
            clear: both;
        }
        .fl{
            float: left;
        }
        .fr_{
            float: right;
            margin-right: 20px;
        }
        .fl_{
            float: left;
            margin-right: 20px;
        }
        .bgff {
            background: #fff;
        }
        .bb-e0e0e0{
            border-bottom:1px solid #e0e0e0;
        }
        .tx-c{
            text-align: center;
        }
        /* ======================资源详情 common===================== */
        .c-price {
            color: #f2752e;
        }
        .fz16{
            font-size: 16px; 
        }
        .fz18{
            font-size: 18px; 
        }


        .pcub {
            display: -webkit-box;
            display: box;
            display: -webkit-flex;
            display: flex;
        }

        .pcub-f1 {
            position: relative;
            -webkit-box-flex: 1;
            box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
        }
        .pcub-te {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
        .pcub-pac {
            -webkit-box-pack: center;
            box-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            box-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
        .p20 {
            padding: 20px
        }
        .ptb20 {
            padding-top: 20px;
            padding-bottom: 20px
        }
        .plr20 {
            padding-left: 20px;
            padding-right: 20px
        }
        .mb20{
            margin-bottom: 20px;
        }
        .ml20{
            margin-left: 20px;
        }
        .hide{
            display: none;
        }
        .pb20{
            padding-bottom:20px;
        }
        .pb10{
            padding-bottom:10px;
        }
        .mt10{
            margin-top:20px;
        }
        .mb10{
            margin-bottom:20px;
        }
        /* ======================资源详情  main===================== */
        .khb-head-box{
            background: #fff;
            height: 60px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 20;
            box-shadow: 0 0 10px 5px #e6e6e6;
        }
        .khb-head{
            height: 100%;
            
        }
        .khb-head .gohome{
            font-size: 20px;
        }
        .ziyuandiushi .img1{
            width: 420px;
            height: 420px;
        }
        .reminder li{
            width: 100% !important;
        }
        .reminder li .tits{
            width: 8.5%;
            margin-right: 2%;
        }
        .mt{
            margin-top: 80px;
        }
        .space{
            display: none;
        }
        .khb-top .logo{
            width: 80px;
            height: 80px;
            margin-right: 20px;
            border-radius: 100%;
            overflow: hidden;
        }
        .khb-top .name{
            font-size: 26px;
            font-weight: bold;
            color: #3c3f46;
        }
        .khb-top .tag span{
            line-height: 19px;
            display: inline-block;
            padding: 0 9px;
            margin-right: 10px;
            background: #F4F7FF;
            color: #8C9CB9;
        }
        .reminder{

        }
        .khb-head,.khb-cont,.khb-top,.khb-hot,.disclaimer,.icp {
            width: 1200px;
            margin-left: auto;
            margin-right: auto;
            font-size: 14px;
            box-sizing: border-box;
        }

        .khb-right {
            float: left;
            width: 300px;
            background: #fff;
        }

        .khb-left {
            width: 880px;
            float: left;
            background: #fff;
            margin-right: 20px;
            box-sizing: border-box;
        }

        .khb-lf-item {
            border: 1px solid #e6e6e6;
        }

        .khb-de-title {
            /* padding: 20px; */
        }
        .khb-de-tips {
            border-bottom: 1px dashed #e6e6e6;
        }
        .tips-item {
            margin-bottom: 10px; 
            float: left;
            width: 50%;
            line-height: 20px;
        }
        .tits {
            width: 17%;
            float: left;
            margin-right: 4%;
            letter-spacing: 2px;
            position: relative;
        }
        .tits::before{
            content: ":";
            position: absolute;
            right: -6px;
        }

        .text {
            width: 74%;
            display: block;
            float: left;
        }
        .resours-intro {
            font-size: 14px;
            line-height: 33px;
            color: #333;
            overflow: hidden;
            text-indent: 2em;
        }
        .like-content li {
            margin-bottom: 10px;
            border-bottom:1px dashed #ccc;
        }
        .img {
            display: inline-block;
            width: 64px;
            height: 64px;
        }
        .p-item {
            width: 0;
            margin-left: 10px;
        }
        .tj a{
            display: inline-block;
        }
        .tj .li{
            width: 64px;
            height: 64px;
            float: left;
            margin-right:20px;
            position: relative;
            overflow: hidden;
            border-radius:100%;
            border:1px solid #f0f0f0;
        }
        .tj .li .tx {
            position: absolute;
            top: 20px;
            display: none;
            width: 100%;
            text-align: center;
            color:#fff;
        }
        .tj .li:hover{
            background: rgba(0, 0, 0, 0.3);
        }
        .tj .li:hover .imgbox{
            display: none;
        }
        .tj .li:hover .tx{
            display: block;
        }
        .imgbox{
            width: 64px;
            height: 64px;
            border-radius:100%;
            margin-right: 20px;
            overflow: hidden;
            color: #f2752e;
            cursor: pointer;
            display: table-cell; 
            vertical-align: middle;
            text-align: center;
        }

        .tj a:hover{
            color: #8C9CB9;
        }
        .disclaimer {
            line-height: 20px;
            padding: 15px 20px;
            background: #eee;
        }
        .icp-box{
            width: 100%;
            background: #3c3f46;
            text-align: center;
            height: 120px;
            line-height: 120px;
        }
        .icp-box .icp{
            color: #fff;
        }
        @media screen and (max-width: 760px) {
            .khb-top,
            .khb-head,
            .khb-cont,
            .khb-hot,
            .icp,
            .disclaimer,
            .khb-left,
            .khb-right,
            .tips-item {
                width: 100%;
            }
            .khb-right{
                margin-top: 20px;
            }
            .tits,.reminder li .tits{
                width: 70px;
                margin-right: 4%;
            }
            .text{
                width: calc(94% - 70px);
            }
            .khb-head{
                padding: 0 10px;
            }
            .ziyuandiushi .img1{
                height: 50%;
                width: 50%;
            }
            .tj a{
                margin-right: 2px;
            }
            .tj .li{
                margin-right: 10px;
            }
            .tj .li,.tj .imgbox{
                width: 32px;
                height:32px;
            }
            .icp-box{
                height: 60px;
                line-height: 60px;
            }
            .fr_{
                float: left;
                margin-right: 10px;
            }
            .space{
                display: block;
            }
        }
    </style>
    <script>
        (function(){
            var bp = document.createElement('script');
            var curProtocol = window.location.protocol.split(':')[0];
            if (curProtocol === 'https') {
                bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
            }
            else {
                bp.src = 'http://push.zhanzhang.baidu.com/push.js';
            }
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(bp, s);
        })();
    </script>
</head>
<body>
<div class="khb-head-box">
    <div class="khb-head pcub pcub-pac">
        <img class="logo" src="" alt="">
        <div class="pcub-f1">
            <div class="bdsharebuttonbox p20 show">
                <a href="#" class="bds_more" data-cmd="more"></a>
                <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
            </div>
        </div>
        <div class="user pcub pcub-pac ">
            <a href="/member/login" class="c-price fz16">登录/注册</a>
        </div>

        <a href="/member" class="user pcub pcub-pac fz16">
            <span>2222</span>
        </a>
    </div>
</div>
<div class="mt"></div>
    @if(count($info))
    <div class="khb-top bgff mb20 p20 clear">
        <div class="logo fl" style="background:url({{$info->logo}}) no-repeat center center;background-size:cover;"></div>
        <div class="fl" style="height:80px;">
            <div class=" mb20">
                <span class="name">{{ $info->title }} </span>
                <span class="fz16 ml20">软文</span>
            </div>
            @if(count($info->label))
                <ul class="tag">
                    @foreach($info->label as $item)
                        <span>{{$item->name}}</span>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="fl space" style="width:100%;border-bottom:1px solid #ccc;margin-bottom:5px;margin-top:5px;"></div>
    </div>
    <div class="khb-cont clear mb20">
        <div class="khb-left p20 @if(!count($info)) hide @endif">
            <!-- 参考报价 -->
            <div class="khb-lf-item plr20 mb20">
                <h3 class="khb-de-title ptb20 fz16">{{$info->title}}参考报价</h3>
                <ul class="clear">
                    <li class="tips-item clear">
                        <div class="tits">参考价格</div>
                        <span class="text c-price">￥{{$info->price}}</span>
                    </li>
                </ul>
                <ul class="clear reminder">
                    <li class="tips-item clear">
                        <div class="tits c-price">温馨提示</div>
                        <span class="text">此信息由用户、网友自主上传.平台审核,如有不足的地方请联系我们,纠正更改,感谢你的支持。</span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits c-price">特别提醒</div>
                        <span class="text ">此资源的信息、价格仅供参考,以实际投放为主。</span>
                    </li>
                </ul>
            </div>
            <!-- 基本信息 -->
            <div class="khb-lf-item plr20 mb20">
                <h3 class="khb-de-title ptb20 fz16">{{$info->name}}基本信息</h3>
                <ul class="clear">
                    <li class="tips-item clear">
                        <div class="tits">区域</div>
                        <span class="text">{{ $info->district?$info->district['name']:'不限' }}</span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">频道分类</div>
                        <span class="text">{{ count($info->channel)?$info->channel[0]['name']:'' }}</span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">网站类型</div>
                        <span class="text">{{ count($info->website)?$info->website[0]['name']:'无' }}</span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">入口级别</div>
                        <span class="text">{{ $info->entrance?$info->entrance->name:'' }}</span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">收录类型</div>

                        <span class="text">{{ count($info->collect)?$info->collect['name']:'' }}</span>
                    </li>

                    <li class="tips-item clear">
                        <div class="tits">链接类型</div>
                        <span class="text">{{ $info->accept_link?'可带链接':'不可带链接' }}</span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">来源需求</div>
                        <span class="text">{{ $info->need_source?'需要来源':'不需要来源' }}</span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">百度权重</div>
                        <span class="text">{{ $info->baidu_weight.'级' }}</span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">案列地址</div>
                        <span class="text"><a href="{{ $info->url }}" style="color:dodgerblue;" target="_blank">查看</a></span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">特殊行业</div>
                        <span class="text">{{ count($info->special)?$info->special[0]['name']:'无' }}</span>
                    </li>
                </ul>
            </div>
            <!-- 接单说明 -->
            <div class="khb-lf-item plr20 mb20">
                <h3 class="khb-de-title ptb20 fz16">{{$info->name}}接单说明</h3>
                <ul class="clear">
                    <li class="tips-item clear">
                        <div class="tits">接稿时间</div>
                        <span class="text"><span class="text">周一至{{$info->receive_end == 5?'周五':'周日'}}</span></span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">标题字数</div>
                        <span class="text">{{ $info->extendArticle['title_num']?:'无' }}</span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">图片数量</div>
                        <span class="text">{{ $info->extendArticle['image_num']?:'无' }}</span>
                    </li>
                    <li class="tips-item clear">
                        <div class="tits">出稿时间</div>
                        <span class="text">{{ $info->draft_time }}小时</span>
                    </li>
                </ul>
            </div>
            <!-- 基本信息 -->
            <div class="khb-lf-item plr20 ">
                <h3 class="khb-de-title ptb20 fz16">{{ $info->title }}资源简介</h3>
                <div class="resours-intro">
                    {{ $info->mark }}
                </div>
            </div>
        </div>
        @else
                <!-- 资源丢失 404  -->
        <div class="khb-cont clear mb20">
            <div class="khb-left p20 ziyuandiushi @if(count($info)) hide @endif">
                <div class="pcub pcub-pac"><img class="img1" src="/images/ziyuandiushi1.png" alt=""></div>
                <div><img class="img2" src="/images/ziyuandiushi2.png" alt=""></div>
            </div>
            @endif
            <div class="khb-right">
                <div class="like plr20">
                    <!-- 相关推荐 -->
                    <h3 class="ptb20 fz16 bb-e0e0e0">相关推荐</h3>
                    <ul class="like-content mb20 mt10">
                        @foreach($recommend as $item)
                            <a href="/sarticle/show/{{$item->id}}" style="display:block;">
                                <li class="pcub bb-e0e0e0 pb10">
                                    <div class="imgbox" style="background:url({{$item->logo}}) no-repeat center center;background-size:cover;" title="{{ $item->title }}" >
                                       
                                    </div>
                                    <div class="pcub-f1 p-item">
                                        <div class="name mb20">{{ $item->title }}</div>
                                        <p class="pcub-te intro" title="{{ $item->slogan }}">差个简介</p>
                                    </div>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
        <div class="khb-hot bgff p20 mb20">
            <h3 class="ptb20 fz16">热门推荐</h3>
            <ul class="tj clear">
                @foreach($guess_like as $item)
                    <a href="/sarticle/show/{{$item->id}}">
                        <li class="li">
                            <div  class="imgbox" title="{{$item->title}}"><img  src="{{$item->logo}}" alt="{{$item->name}}"></div>
                            <p class="tx pcub-te">{{$item->title}}</p>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
        <div class="disclaimer mb20"><strong>免责声明</strong>：
            <p>1.此信息由用户、网友自主上传.平台审核,如有不足的地方请联系我们,纠正、更改、删除。感谢你的支持。</p>
            <p>2.此信息是属于详细信息页面,页面内容有部分在用户上传编辑的时候,有些内容是非必填项,在审核过程当中部分内容可能未一一核实,请谨慎核查，也可联系我们更正。</p>

        </div>
        <div class="icp-box" style="color:#fff;margin-left:10px;">
            © {{$website->record_num}} 版权所有 <a target="_blank" href="http://www.miitbeian.gov.cn" style="color:#fff;margin-left:10px;" ></a>
        </div>
        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
</body>
</html>
