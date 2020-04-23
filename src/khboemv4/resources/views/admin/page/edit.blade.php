@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>编辑</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.page.update',['id'=>$config->id])}}" method="post">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">标识</label>
                    <div class="layui-input-block">
                        <input type="radio" name="tag" value="1" title="公司简介" @if($config->id == 1)checked @endif disabled>
                        <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                            <div>公司简介</div>
                        </div>
                        <input type="radio" name="tag" value="2" title="联系我们" @if($config->id == 2)checked @endif disabled>
                        <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                            <div>联系我们</div>
                        </div>
                        <input type="radio" name="tag" value="3" title="注册协议" @if($config->id == 3)checked @endif disabled>
                        <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                            <div>注册协议</div>
                        </div>
                        <input type="radio" name="tag" value="4" title="隐私条款" @if($config->id == 4)checked @endif disabled>
                        <div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i>
                            <div>隐私条款</div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="" class="layui-form-label">名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" value="{{ $config['name']??'' }}" lay-verify="required" placeholder="请输入名称" class="layui-input"  readonly>
                        </div>
                    </div>
                    @include('UEditor::head');
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
                            <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.article._js')
@endsection