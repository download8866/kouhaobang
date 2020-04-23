<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新闻资讯-{{$website->company}}</title>
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>
    <style>
        .news-list-content-left .listboxwp {padding: 30px 20px; padding-bottom: 31px; }
        .listboxwp {width: 100%;padding: 20px 20px;border-bottom: 20px solid #f9f9f9;font-size: 14px;color: #929291;position: relative;box-sizing: border-box;}
        .txtdetail{ border-top: 1px solid #e0e0e0; padding: 10px 0; color: #999;font-size: 12px;}
        .title{margin-bottom: 10px;font-size: 16px;color: #000;} 
        .page {width: 100%;}
        .routerx {width: 1200px;margin: auto;display: flex;height: 53px;align-items: center;justify-content: flex-start; font-size: 14px;color: #666;}
        .routerx span {margin-left: 3px;margin-right: 3px;}
        .routerx a.current {color: #c72a33;}
        .main {width: 1200px;position: relative;margin: auto;min-height: 450px;text-align: left;}
        .fll {width: 880px;float: left;background-color: #ffffff;box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.1);border-radius: 3px;margin-bottom: 50px;}
        .fll h4.title {font-size: 24px;color: #333;}
        .fll .tips {padding-top: 20px;padding-bottom: 20px;font-size: 14px;color: #999;}
        .fll .tips .router_title {color: #cbabad;}
        .fll .tips span {margin-right: 20px;}
        .fll .articles {padding: 0px 18px;border-top: 1px solid #ececec;border-bottom: 1px solid #ececec;padding-top: 30px;}
        .fll .articles p {font-size: 14px;line-height: 24px;color: #666; margin-bottom: 28px;}
        .fll .articles img {display: block;max-width: 764px;margin: auto;margin-bottom: 28px;}
        .frr {width: 300px;float: right;background-color: #ffffff;box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.1);border-radius: 3px;}
        .bottom {padding-top: 30px;padding-bottom: 30px;}
        .bottom .articleItem {width: 100%;margin-bottom: 10px;font-size: 14px;color: #666;}
        .bottom .articleItem a {color: #666;}
        .bottom .articleItem a:hover {color: #cbabad;}
        .hotBlock {padding: 0px 20px 20px 20px;}
        .hotBlock .title { height: 60px;display: flex;align-items: center;border-bottom: 1px solid #ececec;margin-bottom: 10px;}
        .hotBlock .title .lines {flex: 0 0 4px;height: 18px;background-color: #c72a33; margin-right: 10px;}
        .hotBlock .title .text {font-size: 18px;color: #333;}
        .hotList li a {display: block;font-size: 14px;color: #888;line-height: 2.5;padding-left: 13px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;position: relative;}
        .hotList li a:before {content: "";width: 5px;height: 5px; background-color: #c72a33;position: absolute;top: 16px;left: 0px;}
        .red-hover{color: #000;}
        .hotList li a:hover, .red-hover:hover{color: #c72a33;}
        .ul_anli_right {display: flex;}
        .ul_anli_right li {float: left;margin-left: 10px;display: inline;}
        .ul_anli_right li span {display: block; width: 100px;text-align: center;line-height: 35px;font-size: 14px;color: #666666; }
    </style>
</head>
<body>
    @include('home.template.a.header')
        <div class="routerx"><a href="/">首页</a><span>&gt;</span>新闻资讯</div>
        <div class="main clear">
            <ul class="fll">
                @if($data->count())
                    @foreach($data as $item)
                        <a href="/new/{{$item->id}}" target="_blank">
                            <li class="listboxwp">
                                <h3 class="title red-hover">【{{$item->category['name']}}】{{$item->title}}</h3>
                                <div class="txtdetail">
                                    <span class="mr20">时间：{{ $item->created_at }}</span>

                                    <span class="mr20">阅读数：{{ $item->click }}</span>
                                    <span class="mr20">来源：知识分享</span>
                                </div>
                                <div class="" style="width: 100%;color:#555;">{{$item->intro}}</div>
                            </li>
                        </a>
                    @endforeach
                @endif
            </ul>
            <div class="frr">
                <div class="hotBlock">
                    <div class="title">
                        <div class="lines"></div>
                        <div class="text">热门推荐</div>
                    </div>
                    <ul class="hotList">
                        @foreach($top_ranking as $item)
                            <li data-index="1">
                                <a href="/news/show/{{$item->id}}" target="_blank">{{$item->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="page" style="text-align: center;margin-bottom:40px;">
            @if(isset($data))
                <div class="page_total">共&nbsp;&nbsp;<span style="color:#c72a33;">{{$data->total()}}</span>&nbsp;&nbsp;条</div>
                <div class="page_list">{{$data->links()}}</div>
            @endif
        </div>
    @include('home.template.a.footer')
</body>
</html>