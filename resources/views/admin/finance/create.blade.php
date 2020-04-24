@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header">后台充值</div>
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" method="post"  action="{{route('admin.finance.store')}}">
                {{ csrf_field() }}
                <div class="layui-form-item">
                    <label class="layui-form-label"><strong class="item-required">*</strong>用户手机号</label>
                    <div class="layui-input-block">
                        <input type="text" name="phone" lay-verify="phone" autocomplete="on" placeholder="请输入手机号" class="layui-input" value="{{ $info->name??'' }}" maxlength="15"  id="phone">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><strong class="item-required">*</strong>充值金额</label>
                    <div class="layui-input-block">
                        <input type="text" name="money" lay-verify="money" autocomplete="off" placeholder="充值金额" class="layui-input" value="" maxlength="15">
                    </div>
                </div>
                <div class="layui-form-item layui-layout-admin">
                    <div class="layui-input-block">
                        <div class="layui-footer" style="left: 0;">
                            <button type="submit" class="layui-btn" lay-submit="" lay-filter="save-out">立即提交</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
    var save_flag = true;
        layui.use('form',function () {
            var form = layui.form;
            form.verify({
                phone:function(value, item){ //value：表单的值、item：表单的DOM对象
                    if(!value){
                        return '电话号码不能为空'
                    }
                }
                ,money:function(value, item){ //value：表单的值、item：表单的DOM对象
                    if(!value){
                        return '金额不能为空';
                    }
                }
            });
            //
            form.on('submit(save-out)', function(data){
                if(!save_flag){ return false }
                    save_flag = false;
                var pars = data.field;
                $.ajax({
                    url: "{{route('admin.finance.store')}}",
                    type: 'post',
                    data: pars,
                    success: function (res) {
                        if(res.code == 0 )
                        {
                            layer.msg(res.info,{icon:1})
                            setTimeout(function () {
                                parent.location.reload();
                                parent.layer.close(index_open);
                            },1500);
                        }else{
                            layer.msg(res.info,{icon:2})
                            return false
                        }
                        setTimeout(function(){
                            save_flag = true
                        },500)
                    },
                    error: function () {
                        setTimeout(function(){
                            save_flag = true
                        },500)
                    }
                })
                return false
               /* layer.msg('充值成功',{icon:1});
                setTimeout(function () {
                    parent.location.reload();
                    parent.layer.close(index_open);
                },1500);*/
                //异步提交
                return false;
            });
        })
    </script>


@endsection