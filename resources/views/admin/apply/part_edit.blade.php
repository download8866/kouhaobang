<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="/js/jquery.min.js"></script>
    <style>
        *{margin:0;padding:0;}
        a{text-decoration:none;}
        .ml20{margin-left:20px;}
        .mt20{margin-top:20px;}
        .mb20{margin-bottom:20px;}
        .mr10{margin-right:10px;}
        .fl { float: left; }
        .fr { float: right;  }
        .fn { float: none; }
        .clear:after, .clear:before {  content: "";  display: block; clear: both; }
        .tmp{width:100%;padding:20px;box-sizing:border-box;}
        .tmp .title {font-size: 24px;line-height: 1;color: #4e4e4e;margin-right: 5px;margin-bottom: 10px;}
        .tmp .version-number {font-size: 14px; color: #999;}
        .tmp .tag span{font-size: 12px; margin-right: 10px;color: #999;}
        .tmp .do-num {margin-top:20px;font-size: 14px;}
        .tmp .do-num p{color: #999;border-right: 1px dashed #e7e6eb;margin-right:15px;padding-right:15px;}
        .tmp .do-num .collect{width:76px;text-align:center;margin-right:20px;color: #999;}
        .tmp .do-num span{color: #4d4d4d;font-size: 14px;margin-left: 5px;font-weight: 700;}
        .tmp .intro{background-color: #f7f7f7;padding:10px;font-size:14px;color: #787878;}
        .tmp .price-box{font-size: 14px;padding: 10px 10px 5px;margin-bottom: 20px;margin-top: 10px;line-height: 40px;background-color: #ffede7;color: #787878;}
        .tmp .lable{float:left;display:inline-block;vertical-align:middle;width:75px;}
        .tmp .value{float:left;width:calc( 100% - 75px)}
        .tmp .value.choice .item{background-color: #f7f7f7;border: 1px solid #e7e6eb;color: #000;padding: 6px 15px;margin-right: 10px;margin-bottom: 10px;}
        .tmp .value.choice .item.active{border-color: #cf1010;color: #cf1010;background-color: transparent;background-position: 100% 100%;background-repeat: no-repeat;background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAMAAABhEH5lAAAAPFBMVEUAAADBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDBLCDALQXtAAAAE3RSTlMAwGvy9442689/LAva1ru3Th4Sysx8jQAAAF1JREFUGNNlzlcOwCAMA9CwR3dz/7uWgiIL4s8n2QmpRCUhrWI5K+FTCZtFhCBCEBAEBPFlEMRttpGI+4XuVhThUtlTZCHbO/V9+jx2EpEfhOtXlicCz9kpHmZO+ADORwhDkAohbQAAAABJRU5ErkJggg==);}
        .tmp .price-box .price{color: #cf1010;font-size: 24px;}
        .tmp .version-box{font-size: 14px;line-height: 40px;color: #787878;}
        .tmp .pay-box a{font-size: 14px;background-color: #cf1010;color: #fff;border-color: #cf1010;padding: 9px 15px;border-radius: 4px;}
        .tmp .version-box,.tmp .pay-box {padding-left:10px;}
    </style>
</head>

<body>
<div class="tmp">
    <div class="clear">
        <img class="fl" src="{{$data->logo}}" alt="" style="height: 70px;width: 70px">
        <div class="fl ml20">
            <h2 class="title">{{$data->name}}</h2>
            {{--<p class="version-number">版本号：{{$data->version}}</p>--}}
            <div class="tag"><span>{{$data->mark}}</span></div>
        </div>
    </div>
    {{-- <div class="do-num clear mb20">
         <div class="fl collect">收藏</div>
         <p class="fl">应用评价<span>230</span></p>
         <p class="fl">安装<span>1120</span></p>
         <p class="fl">付费安装<span>392</span></p>
     </div>--}}
    <div class="intro">{{$data->mark}}</div>
    <div class="price-box">
        <div class="clear">
            <div class="lable">版本：</div>
            <div class="value"><span>{{$data->type == 'free'?'免费版本':'商业版本'}}</span></div>
        </div>
        <div class="clear">
            <div class="lable">价格：</div>
            <div class="value"><span class="price">￥{{$data->price}}</span></div>
        </div>
        {{--<div class="clear">
            <div class="lable">服务：</div>
            <div class="value">
                <span class="price" style="font-size: 14px;">￥1</span>
                <span>(期限：12个月)</span>
                <span>购买应用送一个期限升级服务</span>
            </div>
        </div>--}}
    </div>
    <div class="version-box">
        {{-- <div class="clear">
             <div class="lable">版本：</div>
             <div class="value choice">
                 <span class="item active">体验版1</span>
                 <span class="item">体验版2</span>
                 <span class="item">体验版2</span>
                 <span class="item">体验版2</span>
                 <span class="item">体验版2</span>
                 <span class="item">体验版2</span>
             </div>
         </div>
         <div class="clear">
             <div class="lable">类别：</div>
             <div class="value choice">
                 <span class="item active">微信小程序</span>
             </div>
         </div>--}}
        <div class="clear">
            <div class="lable">支持：</div>
            <div class="value">
                <span class="mr10">PHP7.1</span>

            </div>
        </div>
    </div>
    <div class="pay-box mt20">
        @if($data->type == 'free')
            <a href="javascript:;" date-type="install_">立即购买</a>
        @else
            <a href="javascript:;" date-type="buy_">立即购买</a>
        @endif
    </div>
</div>
<script>
    $(function(){
        $('.pay-box a').on('click',function(){
            var type = $(this).attr('date-type')
            var id = "{{$data->tag}}"
            parent.layer.load(1)
            cb(type,id)
        })
    })
    function cb(t,id){
        $.ajax({
            url: "{{route('admin.apply.update')}}",
            type: 'post',
            data: {
                type:'part',
                'id':id,
                "_token":"{{ csrf_token() }}"
            },
            success: function (res) {
                parent.layer.closeAll('loading')
                if(res.code == 0)
                {
                    parent.layer.msg(res.info);
                    setTimeout(function () {
                        parent.location.reload();
                        parent.layer.close(index_open);
                    },1500);
                }else{
                    parent.layer.msg(res.info);
                    parent.layer.close(index_open);
                }
            },
            error: function (err) {parent.layer.closeAll('loading')}
        })
    }
</script>
</body>

</html>