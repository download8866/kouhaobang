<style>
footer {background-color: #f9f9f9;}
.footer-wrap {padding: 20px 0;border-bottom: 1px solid #e7e7e7;}
.footer-left {width: 200px;float: left;}
.footer-left p {font-size: 14px;line-height: 24px;color: #333;}
.footer-logo {margin-bottom: 40px;}
.footer-left .footer-tel {font-size: 22px;letter-spacing: 1px;}
.footer-service a {display: inline-block;padding:0 10px;height: 30px;line-height: 30px;text-align: center;background-color: #b63b3b;border-radius: 15px;color: #ffffff;}
.footer-service a:hover {background-color: #df5151;color: #ffffff!important;}
.footer-tel {margin-bottom: 0;}
.footer-right {float: right;width: 930px;}
.footer-right a:hover{color: #555;}
.footer-right dl {float: left;width: 184px;padding-left: 40px;}
.footer-right dt {font-size: 18px;color: #333;line-height: 40px;}
.footer-right dd {font-size: 14px;color: #999;line-height: 40px;}
.copyright {height: 36px;line-height: 36px;background-color: #f5f4f4;color: #c0bebe;font-size: 12px;text-align: center;}
</style>
<footer>
    <div class="wrap">
        <div class="footer-wrap clear">
            <div class="footer-left">
                <p class="footer-logo" style="width: 200px;height: 130px;">
                    <img style="width: 100%; " src="{{$website->logo}}">
                </p>
            </div>
            <div class="footer-right clear">
                <dl>
                    <dt>业务</dt>
                    @if(strstr($apply, 'sarticle'))
                        <dd><a href="/sarticle">软文价格</a></dd>
                    @elseif(strstr($apply, 'zimeiti'))
                        <dd><a href="/zimeiti">自媒体价格</a></dd>
                        @endif
                    {{--<dd><a href="/login">自媒体价格</a></dd>--}}
                </dl>
                <dl>
                    <dt>媒体学院</dt>
                    <dd><a href="/new">新闻资讯</a></dd>
                </dl>
                <dl>
                    <dt>关于我们</dt>
                    <dd><a href="/about/us">关于我们</a></dd>
                </dl>
                <dl>
                    <dt>合作热线</dt>
                    <dd>
                        <p class="footer-tel">{{$website->phone}}</p>
                    </dd>
                    <dd>
                        <p class="footer-service"><a class="qq clear" target="_blank"
                                href="tencent://message/?Menu=yes&amp;uin={{$website->qq}}&amp;Site=80fans&amp;Service=300&amp;sigT=45a1e5847943b64c6ff3990f8a9e644d2b31356cb0b4ac6b24663a3c8dd0f8aa12a545b1714f9d45"
                                title="联系QQ：{{$website->qq}}">QQ：{{$website->qq}}</a></p>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="w1200"> <a target="_blank" href="http://beian.miit.gov.cn/"
                style="color:black;margin-left:10px;">备案查询</a> {{$website->record_num}}</div>
    </div>
</footer>