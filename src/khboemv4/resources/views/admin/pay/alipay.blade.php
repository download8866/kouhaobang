@extends('admin.base')

@section('content')
    <style>
        .item-required {
            color: red;
        }
    </style>
    <div class="layui-card">
        <div class="layui-card-header">支付宝配置</div>
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" method="post">
                {{ csrf_field() }}
                <div style="border:1px solid green; margin-top: 20px;padding: 20px 0px 20px 0px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">开关</label>
                        <div class="layui-input-block">
                            <input type="checkbox"  name="status" lay-skin="switch" lay-filter="switchTest" lay-text="启用|禁用" @if($info->status === 1) checked @endif>
                            <div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>禁用</em><i></i></div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><strong class="item-required">*</strong>异步回调地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="notify_url" lay-verify="required" autocomplete="on" placeholder="请输入异步回调" class="layui-input" value="{{env('APP_URL').'/alipay/notify'}}"  readonly >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><strong class="item-required">*</strong>同步回调地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="return_url" lay-verify="required" autocomplete="on" placeholder="请输入同步回调" class="layui-input" value="{{env('APP_URL').'/success'}}"   readonly>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><strong class="item-required">*</strong>APPID</label>
                        <div class="layui-input-block">
                            <input type="text" name="app_id" lay-verify="required" autocomplete="on" placeholder="请输入APPID" class="layui-input" value="{{ $appid??'' }}"   >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><strong class="item-required">*</strong>应用私钥</label>
                        <div class="layui-input-block">
                            <textarea name="private_key" rows="10"   placeholder="请输入私钥" lay-verify="required" class="layui-textarea">{{ $private_key ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><strong class="item-required">*</strong>支付宝公钥</label>
                        <div class="layui-input-block">
                            <textarea name="ali_public_key" rows="5"  placeholder="请输入私钥" lay-verify="required" class="layui-textarea">{{ $ali_public_key ?? '' }}</textarea>
                        </div>
                    </div>
                        <div class="layui-form-item layui-layout-admin">
                            <div class="layui-input-block">
                                <div  style="left: 0;margin-top: 100px">
                                    <button type="submit" class="layui-btn" lay-submit="" lay-filter="*">确 认</button>
                                </div>
                            </div>
                        </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script>
        layui.use(['upload','form'],function () {

        });

    </script>
@endsection