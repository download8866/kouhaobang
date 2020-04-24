@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header">短信充值</div>
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" method="post">
                {{ csrf_field() }}
                <div style="border:1px solid green; margin-top: 20px;padding: 20px 0px 20px 0px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label"><strong class="item-required"></strong>账号：</label>
                        <div class="layui-input-block">
                            <input type="text" name="appkey" lay-verify="" autocomplete="on" placeholder="请输入APPID" class="layui-input" value="" maxlength="50"  id="phone">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><strong class="item-required"></strong>密码：</label>
                        <div class="layui-input-block">
                            <input type="password" name="appsecret" lay-verify="" autocomplete="on" placeholder="" class="layui-input" value="" maxlength="50"  >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><strong class="item-required"></strong>短信签名：</label>
                        <div class="layui-input-block">
                            <input type="text" name="signature" lay-verify="" autocomplete="on" placeholder="" class="layui-input" value="" maxlength="50"  >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">短信模板：</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="module[register]" title="找回密码" checked="" disabled>
                            <div class="layui-unselect layui-form-checkbox"><span>找回密码</span><i class="layui-icon layui-icon-ok"></i></div>
                            <input type="checkbox" name="module[forgot]" title="注册模板" checked="" disabled>
                            <div class="layui-unselect layui-form-checkbox"><span>注册模板</span><i class="layui-icon layui-icon-ok"></i></div>
                            <input type="checkbox" name="module[notice]" title="消息通知" checked="" disabled>
                            <div class="layui-unselect layui-form-checkbox"><span>消息通知</span><i class="layui-icon layui-icon-ok"></i></div>
                        </div>
                    </div>
                    <div class="layui-form-item layui-layout-admin">
                        <div class="layui-input-block">
                            <div class="layui-footer" style="left: 0;">
                                <button type="submit" class="layui-btn" lay-submit="" lay-filter="*">确 认</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection