<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{$seo?$seo->title:'口号帮'}}</title>
    <meta name="keywords" content="{{$seo?$seo->keyword:'口号帮'}}">
    <meta name="description" content="{{$seo?$seo->description:'口号帮'}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <link rel="stylesheet" href="/template/a/css/swiper.css">
    <link rel="stylesheet" href="/template/a/css/index.css">
    <link rel="stylesheet" href="/template/a/css/-icon.css">
    <link rel="stylesheet" href="/template/a/css/home.css">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>
    <script src="/template/a/js/swiper.js"></script>
    <style>.w1200{width: 1200px;margin: 0 auto}*{box-sizing:border-box;}</style>
</head>

<body>
    @include('home.template.a.header')
    @include('home.common.notice')
    <div class="banner-wrap">
        <div class="swiper-container" id="banner">
            <div class="swiper-wrapper">
                @if(isset($image)  && count($image->thumb))
                    @foreach($image->thumb as $item)
                        <div class="swiper-slide">
                            <a href="/member/register">
                                <img src="{{$item}}" alt="">
                            </a>
                        </div>
                @endforeach
                @endif
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <section class="change-num">
        <div class="w1200">
            <div class="number">共计<span id="number1">893</span>媒体资源</div>
            <div class="number">昨日<span id="number2">111</span>订单数量</div>
            <div class="number">昨日<span id="number3">222</span>投放客户</div>
            <div class="number">本周<span id="number4">330</span>新增资源</div>
        </div>
    </section>
    <section class="can-do bgff">
        <div class="w1200">
            <div class="section-title">我们能干什么</div>
            <div class="section-intro">一站式软文新闻稿自助发稿平台</div>
            <div class="can-do-list">
                <div class="can-do-item">
                    <div class="can-do-img"><img height="120" src="/template/a/images/gsm_xinwen.png"></div>
                    <div class="can-do-line"></div>
                    <h5>自主新闻发布</h5>
                    <p>10000+底价新闻投放资源，10年软文营销经验。助力软文营销，一站式自主投放平台</p>
                    <div class="can-do-btn">
                        <a href="/member/login">立即发布</a>
                    </div>
                </div>
                <div class="can-do-item">
                    <div class="can-do-img"><img height="120" src="/template/a/images/gsm_zimei.png"></div>
                    <div class="can-do-line"></div>
                    <h5>全媒体广告投放</h5>
                    <p>头条，百家，抖音短视频，微博，微信，1万+媒体资源，急速投放，快速响应，品牌效应快速布局。</p>
                    <div class="can-do-btn">
                        <a href="/member/login">立即发布</a>
                    </div>
                </div>

                <div class="can-do-item">
                    <div class="can-do-img"><img height="120" src="/template/a/images/gsm_ruanwen.png"></div>
                    <div class="can-do-line"></div>
                    <h5>一站式营销服务</h5>
                    <p>为企业提供成熟的营销服务，由专业人员代为设计、投放、推广，以经过验证和成熟的营销规划来快速实现目标。</p>
                    <div class="can-do-btn">
                        <a href="/member/login">立即发布</a>
                    </div>
                </div>
                <div class="can-do-item">
                    <div class="can-do-img"><img height="120" src="/template/a/images/gsm_kaifa.png"></div>
                    <div class="can-do-line"></div>
                    <h5>营销套餐服务</h5>
                    <p>根据公司的产品、行业等特点，由营销专家提供定制化营销服务，专人专项服务，实现宣传目标，让每一笔钱花在刀刃上。</p>
                    <div class="can-do-btn">
                        <a href="/member/login">立即发布</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="advantage">
        <div class="w1200">
            <div class="section-title">我们的优势</div>
            <div class="section-intro">整合全行业丰富、优质的一手媒体广告资源</div>
            <div class="advantage-list">
                <dl>
                    <dt>专业</dt>
                    <dd>专业服务1000多企业客户，一站式营销专业服务商！</dd>
                </dl>
                <dl>
                    <dt>底价</dt>
                    <dd>一手网络媒体资源，帮您节省50%以上推广成本！</dd>
                </dl>
                <dl>
                    <dt>规模</dt>
                    <dd>10000家主流媒体网站，一站式媒体发布，覆盖全网络！</dd>
                </dl>
                <dl>
                    <dt>高效</dt>
                    <dd>简洁易用的24小时发布平台，当天提交当天发布</dd>
                </dl>
                <dl>
                    <dt>规范</dt>
                    <dd>合同、发票等财务流程规范，安全有保证！</dd>
                </dl>
                <dl>
                    <dt>放心</dt>
                    <dd>订单状态实时反馈，客户在线随时回复！</dd>
                </dl>
            </div>
        </div>
    </section>
    <section class="progress">
        <div class="w1200">
            <div class="section-title">媒体发布流程</div>
            <div class="section-intro">简洁易用一键发布24小时自助发布平台</div>
            <div>
                <div class="xmb-service-circle">1
                    <div class="xmb-service-circle-m">
                        咨询服务
                    </div>
                </div>
                <div class="xmb-service-circle">2
                    <div class="xmb-service-circle-m">
                        注册开户
                    </div>
                </div>
                <div class="xmb-service-circle">3
                    <div class="xmb-service-circle-m">
                        媒体投放
                    </div>
                </div>
                <div class="xmb-service-circle">4
                    <div class="xmb-service-circle-m">
                        投放回馈
                    </div>
                </div>
                <div style="position: relative; height:300px">
                    <div class="arrow"></div>
                    <div class="arrow" style=" left: 48%;"></div>
                    <div class="arrow" style="  left: 70.4%;"></div>
                </div>
            </div>
        </div>
    </section>
    <div class="index-market-tool" style="margin-top:40px;height:500px;background:none;">
        <div class="theme-title">自媒体营销工具</div>
        <div class="theme-title-underline"></div>
        <div class="index-market-tool-content clear">
            <div class="index-market-tool-content-li">
                <img class="index-tool-mark" src="/template/a/images/index_tool_mark03.png" alt="">
                <img class="index-tool-number" src="/template/a/images/index_tool_number01.png" alt="">
                <div class="index-tool-underline"></div>
                <p>需求收集&nbsp;&nbsp;&nbsp;&nbsp;媒体筛选&nbsp;&nbsp;&nbsp;&nbsp;效果分析</p>
            </div>
            <div class="index-market-tool-content-li">
                <img class="index-tool-mark" src="/template/a/images/index_tool_mark02.png" alt="">
                <img class="index-tool-number" src="/template/a/images/index_tool_number02.png" alt="">
                <div class="index-tool-underline"></div>
                <p>自主采购&nbsp;&nbsp;&nbsp;&nbsp;查看方案&nbsp;&nbsp;&nbsp;&nbsp;省心省力</p>
            </div>
            <div class="index-market-tool-content-li">
                <img class="index-tool-mark" src="/template/a/images/index_tool_mark01.png" alt="">
                <img class="index-tool-number" src="/template/a/images/index_tool_number03.png" alt="">
                <div class="index-tool-underline"></div>
                <p>引导使用</p>
            </div>
        </div>
    </div>
    <div class="index-special-service" style="background:none;">
        <div class="index-special-service-top clear">
            <div class="index-special-service-top-li v5">
                <a href="javascript:;" class="index-special-service-circle index-video">
                    <i class="iconfont icon-duanshipin"></i>
                </a>
                <h3>自媒体营销</h3>
                <div class="index-special-service-underline"></div>
                <p>自媒体账号 一网打尽</p>
            </div>

            <div class="index-special-service-top-li v5">
                <a href="javascript:;" class="index-special-service-circle index-woa">
                    <i class="iconfont icon-weixin"></i>
                </a>
                <h3>微信营销</h3>
                <div class="index-special-service-underline"></div>
                <p>精准直达 11亿微信用户</p>
            </div>
            <div class="index-special-service-top-li v5">
                <a href="javascript:;" class="index-special-service-circle index-weibo">
                    <i class="iconfont icon-weibo"></i>
                </a>
                <h3>新浪微博</h3>
                <div class="index-special-service-underline"></div>
                <p>微博大V 头部账号 一网打尽</p>
            </div>
            <div class="index-special-service-top-li v5">
                <a href="javascript:;" class="index-special-service-circle index-xhs">
                    <i class="iconfont icon-xiaohongshu"></i>
                </a>
                <h3>小红书</h3>
                <div class="index-special-service-underline"></div>
                <p>标记我的生活 明星生活的另一面</p>
            </div>
        </div>
    </div>
    <section class="resource bgff mb40">
        <div class="w1200">
            <div class="section-title">海量资源媒体</div>
            <div class="section-intro">海量媒体资源，每日不断更新中</div>
            <div class="resource-wrap">
                <ul class="resource-nav" id="resource_nav">
                    <li class="active">知名门户</li>
                    <li>财经媒体</li>
                    <li>科技媒体</li>
                    <li>娱乐媒体</li>
                    <li>其他媒体</li>
                </ul>
                <div class="resource-list" id="resource_list">
                    <ul class="resource-item clear active">
                        <li><img src="/template/a/images/tep/media_1_1.png"></li>
                        <li><img src="/template/a/images/tep/media_1_2.png"></li>
                        <li><img src="/template/a/images/tep/media_1_3.png"></li>
                        <li><img src="/template/a/images/tep/media_1_4.png"></li>
                        <li><img src="/template/a/images/tep/media_1_5.png"></li>
                        <li><img src="/template/a/images/tep/media_1_6.png"></li>
                        <li><img src="/template/a/images/tep/media_1_7.png"></li>
                        <li><img src="/template/a/images/tep/media_1_8.png"></li>
                        <li><img src="/template/a/images/tep/media_1_9.png"></li>
                        <li><img src="/template/a/images/tep/media_1_10.png"></li>
                    </ul>
                    <ul class="resource-item clear">
                        <li><img src="/template/a/images/tep/media_2_1.png"></li>
                        <li><img src="/template/a/images/tep/media_2_2.png"></li>
                        <li><img src="/template/a/images/tep/media_2_3.png"></li>
                        <li><img src="/template/a/images/tep/media_2_4.png"></li>
                        <li><img src="/template/a/images/tep/media_2_5.png"></li>
                        <li><img src="/template/a/images/tep/media_2_6.png"></li>
                        <li><img src="/template/a/images/tep/media_2_7.png"></li>
                        <li><img src="/template/a/images/tep/media_2_8.png"></li>
                        <li><img src="/template/a/images/tep/media_2_9.png"></li>
                        <li><img src="/template/a/images/tep/media_2_10.png"></li>
                    </ul>
                    <ul class="resource-item clear">
                        <li><img src="/template/a/images/tep/media_3_1.png"></li>
                        <li><img src="/template/a/images/tep/media_3_2.png"></li>
                        <li><img src="/template/a/images/tep/media_3_3.png"></li>
                        <li><img src="/template/a/images/tep/media_3_4.png"></li>
                        <li><img src="/template/a/images/tep/media_3_5.png"></li>
                        <li><img src="/template/a/images/tep/media_3_6.png"></li>
                        <li><img src="/template/a/images/tep/media_3_7.png"></li>
                        <li><img src="/template/a/images/tep/media_3_8.png"></li>
                        <li><img src="/template/a/images/tep/media_3_9.png"></li>
                        <li><img src="/template/a/images/tep/media_3_10.png"></li>
                    </ul>
                    <ul class="resource-item clear">
                        <li><img src="/template/a/images/tep/media_4_1.png"></li>
                        <li><img src="/template/a/images/tep/media_4_2.png"></li>
                        <li><img src="/template/a/images/tep/media_4_3.png"></li>
                        <li><img src="/template/a/images/tep/media_4_4.png"></li>
                        <li><img src="/template/a/images/tep/media_4_5.png"></li>
                        <li><img src="/template/a/images/tep/media_4_6.png"></li>
                        <li><img src="/template/a/images/tep/media_4_7.png"></li>
                        <li><img src="/template/a/images/tep/media_4_8.png"></li>
                        <li><img src="/template/a/images/tep/media_4_9.png"></li>
                        <li><img src="/template/a/images/tep/media_4_10.png"></li>
                    </ul>
                    <ul class="resource-item clear">
                        <li><img src="/template/a/images/tep/media_5_1.png"></li>
                        <li><img src="/template/a/images/tep/media_5_2.png"></li>
                        <li><img src="/template/a/images/tep/media_5_3.png"></li>
                        <li><img src="/template/a/images/tep/media_5_4.png"></li>
                        <li><img src="/template/a/images/tep/media_5_5.png"></li>
                        <li><img src="/template/a/images/tep/media_5_6.png"></li>
                        <li><img src="/template/a/images/tep/media_5_7.png"></li>
                        <li><img src="/template/a/images/tep/media_5_8.png"></li>
                        <li><img src="/template/a/images/tep/media_5_9.png"></li>
                        <li><img src="/template/a/images/tep/media_5_10.png"></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="backtop" id="Backtop" style="display: none;">
            <div class="backtop_icon"></div>
        </div>
    </section>
    <section class="article bgff">
        <div class="w1200 ">
            <div class="section-title">新闻资讯</div>
            <div class="section-intro">海量自媒体资讯，掌握行业实时咨询</div>
                <div class="article-wrap">
                @if(count($news))
                    <div class="article-left">
                        <div class="article-img">
                            <img src="/template/a/images/article_img.jpg">
                        </div>
                        <div class="article-date">{{substr($news[0]['created_at'],0,10)}} </div>
                        <div class="article-hot">
                            <h6>{{$news[0]['title']}}</h6>
                            <p>{!! $news[0]['title']  !!}</p>
                            <a href="/new/{{$news[0]['id']}}">详情</a>
                        </div>
                    </div>
                @endif
                @if(count($news))
                    @foreach($news  as $key=> $item)
                        @if($key != 0)
                            <div class="article-right">
                                <ul class="article-list">
                                    <li>
                                        <a href="/new/{{$item->id}}">
                                            <h5>{{$item->title}}</h5>
                                            <p>{!! $item->title !!}</p>
                                            <div></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="article-btn">
                <a href="/new">MORE</a>
            </div>
        </div>
    </section>
    @include('home.template.a.footer')
   
    <script>
        (function($){
            $.fn.numberRock=function(options){
                var defaults={
                    lastNumber:100,
                    duration:2000,
                    easing:'swing'  //swing(默认 : 缓冲 : 慢快慢)  linear(匀速的)
                };
                var opts=$.extend({}, defaults, options);
                $(this).animate({
                    num : "numberRock",
                    // width : 300,
                    // height : 300,
                },{
                    duration : opts.duration,
                    easing : opts.easing,
                    complete : function(){
                        console.log("success");
                    },
                    step : function(a,b){  //可以检测我们定时器的每一次变化
                        //console.log(a);
                        //console.log(b.pos);   //运动过程中的比例值(0~1)
                        $(this).html(parseInt(b.pos * opts.lastNumber));
                    }
                });
            }
        })(jQuery);
    </script>
    <script>
        $(function () {
            //首页banner轮播
            var swiper = new Swiper('#banner', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                autoplay: {
                    delay: 3000,
                    stopOnLastSlide: false,
                    disableOnInteraction: false
                }
            });
            //滚动数字
            changeNumbers('89','111','222','555');
            //海量资源媒体tab切换
            $("#resource_nav").on("click", "li", function () {
                var _t = $(this), index = _t.index();
                _t.addClass("active").siblings().removeClass("active");
                $("#resource_list").children(".resource-item:eq("+ index +")").addClass("active").siblings().removeClass("active");
            });
        });

        function changeNumbers(number1,number2,number3,number4) {
            $("#number1").numberRock({
                lastNumber: number1,
                duration: 5000,
                easing: 'swing',  //慢快慢
            });
            $("#number2").numberRock({
                lastNumber: number2,
                duration: 5000,
                easing: 'swing',  //慢快慢
            });
            $("#number3").numberRock({
                lastNumber: number3,
                duration: 5000,
                easing: 'swing',  //慢快慢
            });
            $("#number4").numberRock({
                lastNumber: number4,
                duration: 5000,
                easing: 'swing',  //慢快慢
            });
        }
    </script>

</body>

</html>