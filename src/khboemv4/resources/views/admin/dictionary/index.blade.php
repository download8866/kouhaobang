@extends('admin.base')
@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @{{# if(d.slug != 'sarticle_time' && d.slug != 'sarticle_price'){}}
                    <a class="layui-btn layui-btn-sm" lay-event="renewal">更新</a>
                    @{{# }}}
                </div>
            </script>
        </div>
    </div>
@endsection


@section('script')
    <script>
        layui.use(['layer','table','form'],function () {
            var layer = layui.layer;
            var form = layui.form;
            var table = layui.table;
            //用户表格初始化
            var dataTable = table.render({
                elem: '#dataTable'
                ,url: "{{ route('admin.dictionary.data') }}" //数据接口
                // ,page: true //开启分页
                ,cols: [[ //表头
                    {field: 'function_name', title: '所属类型', align:'center'}
                    ,{field: 'field_name', title: '字段名称', align:'center'}
                    ,{field: 'slug', title: '字段标识', align:'center'}
                    ,{field: 'content', title: '详情', align:'center'}
                    ,{fixed: 'right',title:'操作', width: 150, align:'center', toolbar: '#options'}
                ]]
                ,id:'dictionaryTable'
            });
            function ss(params) {
                console.log(params)
            }
            //监听工具条
            table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data //获得当前行数据
                    ,layEvent = obj.event; //获得 lay-event 对应的值
                var slug=obj.data.slug;
                if(layEvent === 'edit'){
                    //
                    var route="{{route('admin.dictionary.edit')}}?id="+data.id;
                    var data = {bid:'45545',bname:'66666',price:'9999'};
                    layer.open({
                        type: 2
                        ,title: ['修改信息']
                        ,area: ['760px', '520px']
                        ,shadeClose: true
                        ,shade: 0
                        ,maxmin: true
                        ,content:route

                    });
                }else if(layEvent === 'renewal')
                {
                    layer.confirm('更新至最新数据字典，请谨慎操作！', {
                        btn: ['继续更新','取消']
                    }, function(){
                        $.ajax({
                            type : 'POST',
                            url : '{{ route('admin.dictionary.sync') }}',
                            data : {type:data.slug},
                            cache : false,
                            success : function(data){
                                if(data.code ===1 ){
                                    layer.msg(data.info, {icon: 1, time: 1000})
                                    setTimeout(function(){
                                        table.reload('dictionaryTable');
                                    },1000)
                                }else{
                                    layer.msg(data.info, {icon: 2, time: 1000})
                                }
                            }
                        });
                    }, function(){
                        layer.close(index);
                    });
                }
            });
        })
    </script>
@endsection