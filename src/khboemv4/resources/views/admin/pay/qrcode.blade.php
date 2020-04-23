@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header">支付宝配置</div>
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" method="post">
                {{ csrf_field() }}
                <div style="border:1px solid green; margin-top: 20px;padding: 20px 0px 20px 0px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">开关</label>
                        <div class="layui-input-block">
                            <input type="checkbox"  name="status" lay-skin="switch" lay-filter="switchTest" lay-text="启用|禁用" @if($info->status === 1) checked @endif><div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>禁用</em><i></i></div>
                        </div>
                    </div>
                        <div class="layui-form-item" >
                            <label for="" class="layui-form-label"style="width: 90px" ><strong class="item-required">*</strong>支付宝收款码</label>
                            <div class="layui-input-block" >
                                <div class="layui-upload">
                                    <button type="button" class="layui-btn" id="alipay"><i class="layui-icon">&#xe67c;</i>图片上传</button>
                                    <span class="help">请上传1M以内的png、jpg格式的图片。支付宝APP下载的收款码图片请勿裁剪。</span>
                                    <div class="layui-upload-list" >
                                        <ul id="layui-upload-box2" class="layui-clear">
                                            @if(isset($info->alipay_qrcode))
                                                <li><img  src="{{ env('IMG_URL').$info->alipay_qrcode }}" style="width: 180px;height: 300px" /><p>上传成功</p></li>
                                            @endif
                                        </ul>
                                        <input type="hidden" name="qrcode_alipay" id="qrcode_alipay" lay-verify="my_qrcode_weixin"  value="{{ $info->alipay_qrcode??old('qrcode_alipay') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="layui-form-item" >
                        <label for="" class="layui-form-label"style="width: 90px" ><strong class="item-required">*</strong>微信收款码</label>
                        <div class="layui-input-block" >
                            <div class="layui-upload">
                                <button type="button" class="layui-btn" id="weixin"><i class="layui-icon">&#xe67c;</i>图片上传</button>
                                <span class="help">请上传1M以内的png、jpg格式的图片。微信APP下载的收款码图片请勿裁剪。</span>
                                <div class="layui-upload-list" >
                                    <ul id="layui-upload-box1" class="layui-clear">
                                        @if(isset($info->weixin_qrcode))
                                            <li><img src="{{ env('IMG_URL').$info->weixin_qrcode }}" style="width: 180px;height: 300px" /><p>上传成功</p></li>
                                        @endif
                                    </ul>

                                    <input type="hidden" name="qrcode_weixin" id="qrcode_weixin" lay-verify="my_qrcode_weixin"  value="{{ $info->weixin_qrcode??old('qrcode_weixin') }}">
                                </div>
                            </div>
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
            var upload = layui.upload
            var form = layui.form

            @if(session('success'))
            {{--{{ dd(session('success')) }}--}}
            layer.msg('{{session('success')}}',{icon:6});
            {{--{{session('success')}}--}}
            @endif
            //普通图片上传
            upload.render({
                elem: '#weixin'
                ,url: '{{ route("uploadImage") }}'
                ,multiple: false
                ,data:{"_token":"{{ csrf_token() }}",maxSize:1,filename:'weixin'}
                // ,method:'post'
                ,before: function(obj){
                    obj.preview(function(index, file, result){
                        $('#layui-upload-box1').html('<li><img src="'+result+'" style="width: 180px;height: 300px"/><p>上传中</p></li>')
                    });

                }
                ,done: function(res){
                    //如果上传失败
                    if(res.code == 0){
                        $("#qrcode_weixin").val(res.url);
                        $('#layui-upload-box1 li p').text('上传成功');
                        return layer.msg(res.msg,{icon:6});
                    }
                    return layer.msg(res.msg,{icon:5});
                }
                ,size:1024
            });

            upload.render({
                elem: '#alipay'
                ,url: '{{ route("uploadImage") }}'
                ,multiple: false
                ,data:{"_token":"{{ csrf_token() }}",maxSize:1,filename:'alipay'}
                // ,method:'post'
                ,before: function(obj){
                    obj.preview(function(index, file, result){
                        $('#layui-upload-box2').html('<li><img src="'+result+'" style="width: 180px;height: 300px"/><p>上传中</p></li>')
                    });

                }
                ,done: function(res){
                    //如果上传失败
                    if(res.code == 0){
                        $("#qrcode_alipay").val(res.url);
                        $('#layui-upload-box2 li p').text('上传成功');
                        return layer.msg(res.msg,{icon:6});
                    }
                    return layer.msg(res.msg,{icon:5});
                }
                ,size:1024
            });


        });

    </script>
@endsection