@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>编辑消息</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.message.update')}}" method="post">
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label class="layui-form-label">通知类型</label>
                    <div class="layui-input-block">
                        <input type="radio" name="flag" value="1" title="推送信息" @if($info->flag==1)  checked  @endif>
                        <input type="radio" name="flag" value="2" title="系统公告" @if($info->flag==2)  checked  @endif>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{$info->id}}">
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">标题</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" value="{{$info->title??old('title')}}" lay-verify="required" placeholder="请输入标题" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">内容</label>
                    <div class="layui-input-inline">
                        <textarea name="content" class="layui-textarea" cols="30" rows="6" lay-verify="required" placeholder="请输入内容">{{$info->content??old('content')}}</textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.message')}}" >返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <style>
        .userBox{

        }
        .userBox li{
            display: inline-block;
            float: left;
            padding:10px 22px;
            color: #fff;
            border-radius: 4px;
            margin:0 10px 10px 0;
            position: relative;
        }
        .userBox li.li2{
            background-color: #009688;
        }
        .userBox li.li3{
            background-color: #393D49;
        }
        .userBox li i{
            display: block;
            width: 10px;
            height:10px;
            line-height: 10px;
            color: #fff;
            text-align: center;
            border:1px solid #fff;
            border-radius: 50%;
            position: absolute;
            top:2px;
            right: 2px;
            cursor: pointer;
        }
    </style>
    <script>
        layui.use(['form','layer'], function(){
            var form = layui.form;
            var layer = layui.layer;
            var index_open = parent.layer.getFrameIndex(window.name);
            var index=0;
            form.on('submit(formDemo)', function(data){

                pay_flag = true;
                var pars = data.field;
                $.ajax({
                    url: "{{route('admin.message.update')}}",
                    type: 'post',
                    data: pars,
                    success: function (res) {
                        layer.msg(res.info,{icon:1});
                        setTimeout(function () {
                             parent.location.reload();
                            parent.layer.close(index_open);
                        },1500);
                    },
                    error: function () {

                    }
                })
                return false
                /*setTimeout(function () {
                    parent.location.reload();
                    parent.layer.close(index_open);
                },1500);
                //异步提交
                return false;*/
            });


        });
    </script>
@endsection