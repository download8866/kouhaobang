@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加友情链接</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.link.store')}}" method="post">
                {{csrf_field()}}

                    <div class="layui-form-item">
                        <label for="" class="layui-form-label">名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name"  lay-verify="required" placeholder="请输入名称" class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="" class="layui-form-label">跳转链接</label>
                        <div class="layui-input-block">
                            <input type="text" name="url"  lay-verify="required" placeholder="请输入跳转链接" class="layui-input" >
                        </div>
                    </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">使用状态</label>
                    <div class="layui-input-block">
                        <input type="checkbox"  name="status" lay-skin="switch" lay-filter="switchTest" lay-text="启用|停用"  checked >
                        <div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>停用</em><i></i></div>
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