<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>个人中心</title>
    <link rel="stylesheet" href="/template/modules/css/icon.css">
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <link rel="stylesheet" href="/template/member/css/swiper.css">
    
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>
    <script src="/template/member/js/swiper.js"></script>
    <style>
        body {background:#f5f6fa;}
        .user-price {background: url(/template/a/member/user-icon-balance.png) no-repeat; background-size: 100%;margin-right: 15px;height: 100px;width:160px;}
        .user-price,.user-price a{color:#fff;}
        .status-ul li{border-bottom:2px solid #ffffff;cursor: pointer;padding:10px;float: left;margin-right:20px;}
        .status-ul li.on{border-bottom-color: #4eb6ff;color: #4eb6ff;}

        .week-tj {margin-bottom: 20px;height: 200px;}
        .week-tj .rrs {float: left;width: 23.5%;margin-left: 2%;}
        .week-tj .rrs:first-child {margin-left: 0;}
        .week-tj .rrs .con { border: 1px #eee solid;border-radius: 4px;overflow: hidden;padding: 10px 0;}
        .week-tj .rrs .con > * {margin: 0 auto;margin-top: 5px;text-align: center;}
        .week-tj .rrs .con > *:first-child {margin-top: 0;}
        .res.avatar.article {width: 100px; height: 50px;}
        .res.avatar {position: relative;}
        .res.avatar.article > img {width: 100%;height: 100%;}
        .week-tj .rrs .con .resName {max-width: 190px;text-align: center;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;}
        .week-tj .rrs .con .price {color: #f66;}
        .week-tj .rrs .con .btn { height: 30px;line-height: 30px;width: 120px;text-align: center;font-size: 13px;color: #fff;background: #4eb6ff;border-radius: 4px;cursor: pointer;}
        .rrMore {height: 40px;}
        .rrMore a {display: block;width: 160px;height: 32px;margin: 0 auto;text-align: center;line-height: 32px;border: 1px #4eb6ff solid;border-radius: 4px;background: #fff;color: #4eb6ff;cursor: pointer;}

        .aip-level-text {margin-left: -10px;padding: 1px 8px 1px 15px;font-size: 12px;font-weight: 500;color: #fff;line-height: 18px;border-radius: 0 4px 4px 0;background-color: rgb(162, 103, 62)}
        .aip-level-text-id {padding:0 10px;margin-top: 10px;height: 24px;background: #d6dada;border-radius: 27px;font-size: 12px;text-align: center;color: #fff;line-height: 24px;}
        .btn-bg{color: #fff;border-radius: 27px;background: #4584e8;border: #4584e8;padding: 8px 16px;font-size: 14px;min-width: 88px;display:block;box-sizing:border-box;text-align:center;}
        .a-main{color: #4584e8;}
    </style>
</head>
<body>
    
    @include('home.member.header')
    <div class="wrap clear mtop">
        <div class="fl">
            @include('home.member.menu')
        </div>
        <div class="fr" style="width:980px">
            <div class="bgff clear plr30 ptb40 radius">
                <img class="fl" height="70px" src="/template/member/images/user-av.png" alt="">
                <div class="fl ml20">
                    <h4 class="clear"><span class="fl">{{$info->username??$info->phone}} </span>{{--<img style="margin-top:-4px;height:28px;" class="fl" src="/template/a/member/ping1.png" alt="">--}}{{--<em class="aip-level-text fl">普通LV5</em>--}}</h4>
                    <div class="aip-level-text-id">{{$info->company??'--'}}</div>
                    @if($info->industry)
                    <div class="fz12 c-666 mt5">行业信息: {{$info->industry}}</div>
                    @endif
                </div>
                <div class="fr ">
                    <div class="clear tx-c">
                         <a class="fl db border-r plr40 pt10 mr40" style="color:#fff;background:url('/template/member/images/user-balance-bg.png');background-size: 100% 100%;">
                            <p class="fz30 fontdin">{{isset($money)?$money->total_money:0}}</p>
                            <p class="fz14 pb10">余额</p>
                        </a>
                        <a href="{{route('home.member.finance.pay')}}" class="btn-bg fl">充值</a>
                    </div>
                </div>
            </div>
            <div class="clear mt20">
                <div class="swiper-container fl bgff radius" id="banner" style="width:480px;height:180px;">
                    <div class="swiper-wrapper">
                        @if(count($image->thumb))
                            @foreach($image->thumb  as $item)
                            <div class="swiper-slide">
                                <img src="{{$item}}" alt="">
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="fr bgff radius fz12" style="width:480px;height:180px;">
                    <div class="ptb15 plr20 fz16">公告通知</div>
                    @if(count($message))
                        @foreach($message  as $item)
                            <a href="{{route('home.member.message')}}" class="clear plr20 pb15 db">
                                <em class="fl">{{$item->title}}</em>
                                <em class="fr a-main">详情 <i class="iconfont icon-youla fz12"></i></em>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="clear mt20">
                <div class="fl bgff radius" style="width:480px;height:180px;">
                    <div class="ptb10 plr20 fz16">订单统计 <a href="{{ route('home.member.sarticle.order')}}" class="fr fz12 a-main">全部订单 <i class="iconfont icon-youla fz12"></i></a></div>
                    <div class="clear tx-c mt40">
                        <a href="{{ route('home.member.sarticle.order')}}"  class="fl db border-r" style="width:33%;">
                            <p class="fz30 fontdin c-666">{{$order_accept}}</p>
                            <p class="fz14 c-999">待执行</p>
                        </a>
                        <a href="{{ route('home.member.sarticle.order')}}" class="fl db border-r" style="width:33%;">
                            <p class="fz30 fontdin c-666">{{$order_for}}</p>
                            <p class="fz14 c-999">执行中</p>
                        </a>
                        <a href="{{ route('home.member.sarticle.order')}}" class="fl db" style="width:33%;">
                            <p class="fz30 fontdin c-666">{{$order_sure}}</p>
                            <p class="fz14 c-999">已完成</p>
                        </a>
                    </div>
                </div>
                <div class="fr bgff radius" style="width:480px;height:180px;">
                    <div class="ptb10 plr20 fz16">财务统计 <a href="{{route('home.member.finance')}}" class="fr fz12 a-main">我的财务 <i class="iconfont icon-youla fz12"></i></a></div>
                    <div class="clear tx-c mt40 ">
                        <a href="{{route('home.member.finance')}}" class="fl db border-r" style="width:49%;">
                            <p class="fz30 fontdin c-666">{{$pay}}</p>
                            <p class="fz14 c-999">累计消费</p>
                        </a>
                        <a href="{{route('home.member.finance')}}" class="fl db" style="width:50%;">
                            <p class="fz30 fontdin c-666">{{$charge}}</p>
                            <p class="fz14 c-999">累计充值</p>
                        </a>
                        
                    </div>
                </div>
               
            </div>
            <div class="bgff clear p20 mt20 radius">
                <div class="ptb10 fz16">本周精选 <a href="/member/sarticle" class="fr fz12 a-main">更多推荐 <i class="iconfont icon-youla fz12"></i></a></div>
                <ul class="fz16 clear status-ul mb20 bb">
                    <li class="on" data-val="">软文</li>
                    <!-- <li class="" data-val="2">自媒体</li> -->
                </ul>
                <ul class="week-tj clear">
                    @if(count($sarticle))
                        @foreach($sarticle as $item)
                            <li class="rrs">
                                <div class="con">
                                    <div class="res avatar article">
                                        <img src="{{$item->logo}}">
                                    </div>
                                    <div class="resName">{{$item->title}}</div>
                                    <div class="pricer">价格：<span class="price">{{$item->price}}元</span></div>
                                    <div class="btn addCart active add-cart" data-id="{{$item->id}}">加入购物车</div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <div class="rrMore"><a href="/member/sarticle" class="viewMoreBtn">更多推荐&gt;&gt;</a></div>
            </div>           
        </div>
    </div>
    @include('home.member.icp')
    <script>
        $(function() {
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
            addCart()
        })
        function addCart(){
            $('.add-cart').on('click',function() {
                var _this = this;
                $.ajax({
                    url: "/member/sarticle/cart/store",
                    type: 'post',
                    data: {id: $(_this).attr('data-id'),'_token': "{{csrf_token()}}"},
                    success: function (res) {
                        location.href = "/member/sarticle"
                    },
                    error: function () {
                        location.href = "/member/sarticle"
                    }
                })
            })
        }
    </script>
</body>
</html>