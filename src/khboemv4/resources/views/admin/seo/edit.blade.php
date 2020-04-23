@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>SEO编辑</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.seo.update',['id'=>$config->id])}}" method="post">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">标识</label>
                    <div class="layui-input-block">
                        <input type="radio" name="sex" value="nan" title="首页" checked>
                        <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                            <div>首页</div>
                        </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">seo标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" value="{{ $config['title']??'' }}" lay-verify="required" placeholder="请输入关键词" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">seo关键字</label>
                    <div class="layui-input-block">
                        <input type="text" name="keyword" value="{{ $config['keyword']??'' }}" lay-verify="required" placeholder="请输入关键词" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">seo描述</label>
                    <div class="layui-input-block">
                        <textarea class="layui-textarea" name="description" cols="30" rows="10">{{ $config['description']??'' }}</textarea>
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