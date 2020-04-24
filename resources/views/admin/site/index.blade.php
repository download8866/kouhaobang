@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>门户设置</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.site.update')}}" method="post">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="layui-form-item" >
                    <label for="" class="layui-form-label"style="width: 90px" ><strong class="item-required">*</strong>网站LOGO</label>
                    <div class="layui-input-block" >
                        <div class="layui-upload">
                            <button type="button" class="layui-btn" id="img"><i class="layui-icon">&#xe67c;</i>图片上传</button>
                            <span class="help">请上传1M以内的png、jpg格式的图片,尺寸建议120*50</span>
                            <div class="layui-upload-list" >
                                <ul id="layui-upload-box2" class="layui-clear">
                                    @if(isset($config->logo))
                                        <li><img  src="{{ env('IMG_URL').$config->logo }}" style="width: 180px;height: 200px" /><p>上传成功</p></li>
                                    @endif
                                </ul>
                                <input type="hidden" name="logo" id="logo"   value="{{ $config->logo??old('logo') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">网站名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="company" value="{{ $config['company']??'' }}" lay-verify="required" placeholder="请输入网站名称" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">备案信息</label>
                    <div class="layui-input-block">
                        <input type="text" name="record_num" value="{{ $config['record_num']??'' }}" lay-verify="required" placeholder="请输入备案信息" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">第三方统计代码</label>
                    <div class="layui-input-block">
                        <textarea class="layui-textarea" name="three" cols="30" rows="10">{{ $config['three']??'' }}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">专属客服</label>
                    <div class="layui-input-block">
                        <input type="text" name="username" value="{{ $config['username']??old('username') }}" lay-verify="required" placeholder="请输入联系人" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item" >
                    <label for="" class="layui-form-label"style="width: 90px" ><strong class="item-required">*</strong>联系二维码</label>
                    <div class="layui-input-block" >
                        <div class="layui-upload">
                            <button type="button" class="layui-btn" id="qrcode_img"><i class="layui-icon">&#xe67c;</i>图片上传</button>
                            <span class="help">请上传1M以内的png、jpg格式的图片,尺寸建议100*100</span>
                            <div class="layui-upload-list" >
                                <ul id="layui-upload-box3" class="layui-clear">
                                    @if(isset($config->qrcode))
                                        <li><img  src="{{ env('IMG_URL').$config->qrcode }}" style="width: 180px;height: 200px" /><p>上传成功</p></li>
                                    @endif
                                </ul>
                                <input type="hidden" name="qrcode" id="qrcode"   value="{{ $config->logo??old('logo') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">联系电话</label>
                    <div class="layui-input-block">
                        <input type="text" name="phone" value="{{ $config['phone']??old('phone') }}" lay-verify="required" placeholder="请输入联系电话" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">联系QQ</label>
                    <div class="layui-input-block">
                        <input type="text" name="qq" value="{{ $config['qq']??old('qq') }}" lay-verify="required" placeholder="请输入联系QQ" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">工作时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="job_time" value="{{ $config['job_time']??'工作日：9:00-18:00' }}" lay-verify="required" placeholder="工作日：9:00-18:00" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
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
            upload.render({
                elem: '#img'
                ,url: '{{ route("uploadImage") }}'
                ,multiple: false
                ,data:{"_token":"{{ csrf_token() }}",maxSize:1,filename:'alipay'}
                // ,method:'post'
                ,before: function(obj){
                    obj.preview(function(index, file, result){
                        $('#layui-upload-box2').html('<li><img src="'+result+'" style="width: 180px;height: 200px"/><p>上传中</p></li>')
                    });
                }
                ,done: function(res){
                    //如果上传失败
                    if(res.code == 0){
                        $("#logo").val(res.url);
                        $('#layui-upload-box2 li p').text('上传成功');
                        return layer.msg(res.msg,{icon:6});
                    }
                    return layer.msg(res.msg,{icon:5});
                }
                ,size:1024
            });
            upload.render({
                elem: '#qrcode_img'
                ,url: '{{ route("uploadImage") }}'
                ,multiple: false
                ,data:{"_token":"{{ csrf_token() }}",maxSize:1,filename:'alipay'}
                // ,method:'post'
                ,before: function(obj){
                    obj.preview(function(index, file, result){
                        $('#layui-upload-box3').html('<li><img src="'+result+'" style="width: 180px;height: 200px"/><p>上传中</p></li>')
                    });
                }
                ,done: function(res){
                    //如果上传失败
                    if(res.code == 0){
                        $("#qrcode").val(res.url);
                        $('#layui-upload-box3 li p').text('上传成功');
                        return layer.msg(res.msg,{icon:6});
                    }
                    return layer.msg(res.msg,{icon:5});
                }
                ,size:1024
            });


        });

    </script>
@endsection