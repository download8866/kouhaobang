<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>关于我们-{{$website->company}}</title>
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>
    <style>
        .m-top {padding: 0 20px;overflow: hidden;height: 56px; line-height: 56px;border-bottom: 1px solid #ddd;}
        .breadcrumb { margin: 0 auto;overflow: hidden;max-width: 1200px;}
        .breadcrumb li {float: left;}
        .breadcrumb li a {color: #0080ff;}
        .breadcrumb li a:hover {color: #2288fe;}
        .breadcrumb li .gt {margin: 0 3px;font-size: 14px;color: #999;}

        .container {margin: 0 auto; padding: 0;}
        .aboutcontainer {margin: 0 auto;background: #fff;}
        .bggray {padding: 80px 0;background: #f5f5f5;}
        .bggray.margin {padding: 0;}
        .bgwhite {background: #fff;}
        .about-title {margin: 0 auto;max-width: 1200px;height: 80px;text-align: center;}
        .about-title li {margin: 0 25px;padding: 0 15px;height: 80px;line-height: 80px;color: #000;display: inline-block;font-size: 16px;}
        .about-title a {display: block;color: #000;}
        .about-title li:hover,
        .about-title .active {border-bottom: 2px solid #a80e32;}
        .about-title .active a{color: #a80e32;font-weight: bold;}
        .aboutcontainer {min-height:40vh;}
        .aboutcontainer .main{width:1200px;margin: 0 auto;}
        .aboutcontainer .title{text-align: center;color: #373232;font-size: 32px;margin-bottom: 40px;padding-top: 40px;}
        .content {padding: 20px 0;}
    </style>
</head>
<body>
    @include('home.template.a.header')
        <div class="inner_banner">
            <img src="/template/modules/images/about-banner.jpg" alt="" class="img">
        </div>
        <div class="container bggray margin" id="tabs">
            <ul class="about-title">
                <li onclick="chooseItems(0)" class="active"><a href="javascript:void(0)" target="_parent">公司简介</a></li>
                <li onclick="chooseItems(1)"><a href="javascript:void(0)" target="_parent">联系我们</a></li>
            </ul>
            <div class="aboutcontainer" id="about-five">
                <div class="main">
                    <h1 class="title">公司简介</h1>
                    <div class="content"> {!! $company->content !!}  </div>
                </div>
            </div>
            <div class="aboutcontainer" id="about-six" style="display: none;">
                <div class="main">
                    <h1 class="title">联系我们</h1>
                    <div class="content"> {!! $contact->content !!} </div>
                </div>
            </div>
        </div>
        <script>
            function chooseItems(index){
                $('.about-title>li').removeClass('active');
                $('#tabs>div').hide();
                $('.about-title>li').eq(index).addClass('active')
                $('#tabs>div').eq(index).show();
            }
        </script>
    @include('home.template.a.footer')
</body>
</html>