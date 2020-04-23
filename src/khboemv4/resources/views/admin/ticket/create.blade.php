@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>填写工单</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" >
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">标识</label>
                    <div class="layui-input-block">
                        <input type="radio" name="type" value="1" title="系统"  checked>
                        <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                            <div>系统</div>
                        </div>
                        <input type="radio" name="type" value="2" title="运营"  >
                        <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                            <div>运营</div>
                        </div>
                        <input type="radio" name="type" value="3" title="资源"  >
                        <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                            <div>资源</div>
                        </div>
                        <input type="radio" name="type" value="4" title="意见反馈"  >
                        <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                            <div>意见反馈</div>
                        </div>
                        <input type="radio" name="type" value="4" title="投诉"  >
                        <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                            <div>投诉</div>
                        </div>

                    </div>
                    <div class="layui-form-item">
                        <label for="" class="layui-form-label">标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" value="" lay-verify="required" placeholder="请输入名称" class="layui-input">
                        </div>
                    </div>
                    @include('vendor.ueditor.head')
                    <div class="layui-form-item">
                        <label for="" class="layui-form-label">内容</label>
                        <div class="layui-input-block">
                            <script id="container" name="content" type="text/plain">
                                {!! $config->content??old('content') !!}
                            </script>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button  class="layui-btn" lay-submit="" lay-filter="save-out">确 认</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.setHeight(400);
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
        layui.use(['form','layer','upload'], function() {
            var form = layui.form;
            var layer = layui.layer;

            form.on('submit(save-out)', function(data){
                pay_flag = true;
                var pars = data.field;
                $.ajax({
                    url: "{{route('admin.ticket.store')}}",
                    type: 'post',
                    data: pars,
                    success: function (res) {
                        console.log()
                        setTimeout(function () {
                            parent.location.reload();
                            parent.layer.close(index_open);
                        },1500);
                    },
                    error: function () {

                    }
                })
                return false
            });
        })
    </script>
@endsection