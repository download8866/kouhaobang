@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('seo.config')
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @endcan

                </div>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('seo.config')
        <script>
            layui.use(['layer','table'],function () {
                var table = layui.table;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    ,height: 500
                    ,url: "{{ route('admin.seo.data') }}" //数据接口
                    ,page: true //开启分页
                    ,cols: [[ //表头
                        {checkbox: true,fixed: true}
                        ,{field: 'id', title: 'ID', sort: true,width:80}
                        ,{field: 'title', title: '标题'}
                        ,{field: 'keyword', title: '关键词'}
                        ,{field: 'description', title: '描述'}
                        ,{field: 'created_at', title: '创建时间'}
                        ,{field: 'updated_at', title: '更新时间'}
                        ,{fixed: 'right', width: 220, align:'center', toolbar: '#options'}
                    ]]
                });

                //监听工具条
                table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        ,layEvent = obj.event; //获得 lay-event 对应的值
                     if(layEvent === 'edit'){
                        location.href = '/admin/seo/'+data.id+'/edit';
                    }
                });

            })
        </script>
    @endcan
@endsection