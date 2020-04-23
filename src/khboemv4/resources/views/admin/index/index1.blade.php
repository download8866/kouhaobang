@extends('admin.base')

@section('content')
    <div class="layui-card">

        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="position">
                @{{ d.position.name }}
            </script>
            <script type="text/html" id="thumb">
                <a href="@{{d.thumb}}" target="_blank" title="点击查看"><img src="@{{d.thumb}}" alt="" width="28" height="28"></a>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('config.advert')
    <script>
        layui.use(['layer','table','form'],function () {
            var layer = layui.layer;
            var form = layui.form;
            var table = layui.table;
            //用户表格初始化
            var dataTable = table.render({
                elem: '#dataTable'
                , height: 500
                , url: "{{ route('admin.data2') }}" //数据接口
                , page: true //开启分页
                , cols: [[ //表头
                    {checkbox: true, fixed: true}
                    , {field: 'version', title: '版本号'}
                    , {field: 'slug', title: '模块',templet: function(d){
                        if(d.slug == 'template')
                        {
                            return '模板';
                        }else if(d.slug == 'apply'){
                            return '应用';
                        }else if(d.slug == 'part'){
                            return '组件';
                        }else{
                            return '基础框架';
                        }
            }}
                    , {field: 'content', title: '更新内容'}
                    , {field: 'created_at', title: '官方更新时间'}
                ]]
            });

            //监听工具条
            table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data //获得当前行数据
                        ,layEvent = obj.event; //获得 lay-event 对应的值
                if(layEvent === 'download'){
                    $.post('/admin/download',{id:data.id},function(res){
                        if(res.code == 0){
                            layer.msg('文件'+res.data.file_name+'已下载至'+res.data.save_path,{'icon':1,time:2000});
                            window.location.reload();
                        }else{
                            layer.msg(res.msg,{'icon':2,time:2000});
                        }
                    });
                } else if(layEvent === 'install'){
                    $.post('/admin/install',{id:data.id},function(res){
                        console.log(res)
                    });
                }
            });

            //搜索
            $("#searchBtn").click(function () {
               layer.msg('搜索官方版本信息')
            })
        });
    </script>
    @endcan
@endsection