@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header">密钥配置</div>
        <div class="layui-card-body" style="padding: 15px;">

            {{ csrf_field() }}
            <div style="border:1px solid green; margin-top: 20px;padding: 20px 0px 20px 0px;">
                <div class="layui-form-item">
                    <label class="layui-form-label"><strong class="item-required"></strong>AppKey：</label>
                    <div class="layui-input-block">
                        <input type="text" name="app_key" lay-verify="" autocomplete="on" placeholder="" class="layui-input" value="{{$app_key}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><strong class="item-required"></strong>AppSecret：</label>
                    <div class="layui-input-block">
                        <input type="text" name="app_secret" lay-verify="" autocomplete="on" placeholder="" class="layui-input" value="{{$app_secret }}"   >
                    </div>
                </div>

                <div class="layui-form-item ">
                    <div class="layui-input-block">
                        <div class="layui-footer" style="left: 0;">
                            <button type="submit" class="layui-btn" lay-submit="" lay-filter="*" >确 认</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        layui.use(['layer','table','form'],function () {
            var layer = layui.layer;

            $(".layui-btn").click(function () {
                $.post("{{route('admin.secret.update')}}",{'oem_id':$('input[name="oem_id"]').val(),'app_key':$('input[name="app_key"]').val(),'app_secret':$('input[name="app_secret"]').val()},function (data) {
                    if (data.code === 200) {
                        layer.msg(data.msg, {icon: 1});
                    } else {
                        layer.msg(data.msg, {icon: 2});
                    }

                })
            });
        })
    </script>
@endsection