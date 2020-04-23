<style>
    .right-layout{position: fixed;z-index:999;top:30%;right:0;border-top-left-radius: 10px; border-bottom-left-radius: 10px;border: 1px #a0a0a0 solid;width: 160px;background: #ffffff;}
    .qrcode {width: 96px;margin-left:auto;margin-right:auto;}
    .qrcode img{width:100%;}
    .manageQQ { display: table;height: 30px;line-height: 30px; width: 100%;background: #4eb6ff; border-radius: 5px;color:#fff;}
    .manageQQ:hover{color:#fff;}
    .color-blue{color:#4eb6ff}
    .abs.hidebox { position: absolute;width: 26px;height: 26px;text-align: center;line-height: 26px;font-size: 18px;top: 6px;right: 4px;cursor:pointer;}
    .abs.hidebox:before {content: "✖";}
</style>
<div class="right-layout tx-c fz14" >
    <div class="ptb10 bb c-666"><span>微信扫一扫关注</span></div>
    <div class="qrcode mtb10"><img src="{{$website->qrcode}}" alt=""></div>
    <div class="pb10 bb c-666"><span>扫码了解更多内容</span></div>
    <div class="ptb10 bb fz16"><span>专属客服经理</span></div>
    <div class="ptb10 fz16"><span>{{$website->username}}</span></div>
    <div class="plr10"><a class="manageQQ tx-c" id="manageQQ" target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin={{$website->qq}}&amp;site=qq&amp;menu=yes" title="{{$website->username}} QQ号码：{{$website->qq}}">QQ 在线联系</a></div>
    <div class="p10 color-blue">电话 {{$website->phone}}</div>
    <div class="plr10 pb20">{{$website->job_time}}</div>
    <span class="abs hidebox" onClick="$(this).parent().remove()"></span>
</div>